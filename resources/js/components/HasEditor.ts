import { defineComponent, PropType } from 'vue'
import { Editor, EditorOptions } from '@toast-ui/editor'
import {EditorProps, NovaField, PluginName} from '__types__'
import DOMPurify, { Config } from 'dompurify'
import _ from 'lodash'

import '@toast-ui/editor/dist/i18n/ar'
import '@toast-ui/editor/dist/i18n/cs-cz'
import '@toast-ui/editor/dist/i18n/de-de'
import '@toast-ui/editor/dist/i18n/es-es'
import '@toast-ui/editor/dist/i18n/fi-fi'
import '@toast-ui/editor/dist/i18n/fr-fr'
import '@toast-ui/editor/dist/i18n/gl-es'
import '@toast-ui/editor/dist/i18n/it-it'
import '@toast-ui/editor/dist/i18n/ja-jp'
import '@toast-ui/editor/dist/i18n/ko-kr'
import '@toast-ui/editor/dist/i18n/nb-no'
import '@toast-ui/editor/dist/i18n/nl-nl'
import '@toast-ui/editor/dist/i18n/pl-pl'
import '@toast-ui/editor/dist/i18n/ru-ru'
import '@toast-ui/editor/dist/i18n/sv-se'
import '@toast-ui/editor/dist/i18n/tr-tr'
import '@toast-ui/editor/dist/i18n/uk-ua'
import '@toast-ui/editor/dist/i18n/zh-cn'
import '@toast-ui/editor/dist/i18n/zh-tw'

import chart from '@toast-ui/editor-plugin-chart'
import codeSyntaxHighlight from '@toast-ui/editor-plugin-code-syntax-highlight'
import colorSyntax from '@toast-ui/editor-plugin-color-syntax'
import tableMergedCell from '@toast-ui/editor-plugin-table-merged-cell'
import uml from '@toast-ui/editor-plugin-uml'

const defaultPlugins: Record<PluginName, any> = {
  chart,
  codeSyntaxHighlight,
  colorSyntax,
  tableMergedCell,
  uml,
}

export default defineComponent({
  mixins: [window.LaravelNova.HandlesValidationErrors],

  props: {
    field: {
      type: Object as PropType<NovaField>,
      required: true,
    },
  },

  data: () => ({
    editor: null as Editor | null,
    editorConfig: {} as EditorProps,
    observer: null as MutationObserver | null,
    viewer: false,
  }),

  created() {
      this.editorConfig = this.field.editor
  },

  mounted() {
    this.initializeCloudinary()
  },

  beforeUnmount() {
    if (this.observer) {
      this.observer.disconnect()
    }
  },

  computed: {
    darkMode() {
      return document.documentElement.classList.contains('dark')
    },

    errorClasses() {
      const classes: string[] = this.hasError ? [this.errorClass] : []

      if (this.field.editor.options.height === 'auto') {
        classes.push('auto-height')
      }

      return classes
    },
  },

  watch: {
    currentlyIsVisible(newValue, oldValue) {
      if (newValue && !oldValue) {
        setTimeout(() => {
          this.mountEditor(this.value)
        }, 100)
      }
    },

    errorClasses(newValue) {
      if (!this.currentlyIsVisible) {
        return
      }

      const ref = this.$refs.editor as HTMLElement | null
      if (newValue.length) {
        ref?.firstElementChild?.classList.add('form-control-bordered-error')
      } else {
        ref?.firstElementChild?.classList.remove('form-control-bordered-error')
      }
    }
  },

  methods: {
    initializeCloudinary(): void {
      let useImage = false

      for (const items of this.editorConfig.options.toolbarItems) {
        if (_.includes(items, 'image')) {
          useImage = true
          break
        }
      }

      if (!this.editorConfig.useCloudinary || !useImage) {
        return
      }

      this.$cloudinaryMediaLibrary.init({
        ...this.editorConfig.cloudinary,
        multiple: false,
        insert_caption: 'Insert',
      })
    },

    sanitizeHtml(html: string) {
      let config: Config = {}

      if (this.editorConfig.allowIframe) {
        config.ADD_TAGS = ['iframe']
      }

      return DOMPurify.sanitize(html, config)
    },

    mountEditor(initialValue: string): void {
      const customHTMLRenderer = {
        htmlBlock: {
          // @ts-ignore
          iframe(node) {
            return [
              { type: 'openTag', tagName: 'iframe', outerNewLine: true, attributes: node.attrs },
              { type: 'html', content: node.childrenHTML },
              { type: 'closeTag', tagName: 'iframe', outerNewLine: true },
            ]
          },
        },
      }

      const plugins = this.editorConfig
        .options
        .plugins
        .map((name) => {
          return defaultPlugins[name]
        })
        .filter((plugin) => !!plugin)

      const config = {
        el: this.$refs.editor,
        initialValue,
        customHTMLSanitizer: this.sanitizeHtml,
        viewer: this.viewer,
        ...this.editorConfig.options,
        ...(this.editorConfig.allowIframe ? { customHTMLRenderer } : {}),
        ...(this.darkMode ? { theme: 'dark' } : {}),
        plugins,
      } as unknown as EditorOptions

      this.editor = Editor.factory(config) as Editor

      this.observer = new MutationObserver(this.handleDarkMode)
      this.observer.observe(document.documentElement, {
        attributes: true,
        attributeOldValue: true,
        attributeFilter: ['class'],
      })

      this.editorMounted()
    },

    editorMounted(): void {
      //
    },

    handleDarkMode(): void {
      const isDarkMode = document.documentElement.classList.contains('dark')
      const ref = this.$refs.editor as HTMLElement
      const el = (this.viewer ? ref : ref.firstElementChild) as HTMLElement

      if (isDarkMode && !el.classList.contains('toastui-editor-dark')) {
        el.classList.add('toastui-editor-dark')
      } else if (!isDarkMode && el.classList.contains('toastui-editor-dark')) {
        el.classList.remove('toastui-editor-dark')
      }
    },
  },
})
