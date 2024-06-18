<script lang="ts">
import { defineComponent, PropType } from 'vue'
import HasEditor from './HasEditor'

export default defineComponent({
  mixins: [window.LaravelNova.DependentFormField, HasEditor],

  props: {
    resourceName: {
      type: String,
      required: true,
    },
    resourceId: {
      type: [String, Number] as PropType<string | number>,
      required: true,
    },
  },

  mounted() {
    if (this.currentlyIsVisible) {
      this.mountEditor(this.value)
    }
  },

  methods: {
    /*
     * Set the initial, internal value for the field.
     */
    setInitialValue() {
      this.value = this.currentField.value || ''
    },

    /**
     * Fill the given FormData object with the field's internal value.
     */
    fill(formData: FormData) {
      formData.append(this.currentField.attribute, this.value || '')
    },

    editorMounted() {
      this.editor?.on('query', (event: string, data: { popupName: string }) => {
        if (event === 'getPopupInitialValues' && data.popupName === 'image') {
          if (this.editorConfig.useCloudinary) {
            setTimeout(() => {
              this.editor?.eventEmitter.emit('closePopup')
            }, 5)

            this.$cloudinaryMediaLibrary.show(data => {
              const image = data.assets[0]

              this.editor?.exec('addImage', {
                imageUrl: image.secure_url,
                altText: image.id,
              })
            })
          }
        }
      })

      this.editor?.on('change', () => {
        this.value = this.editor?.getMarkdown().trim()
      })

      const ref = this.$refs.editor as HTMLElement
      ref.firstElementChild?.classList.add('form-control-bordered', 'form-control')
    },
  },
})
</script>

<template>
  <DefaultField
    :field="currentField"
    :errors="errors"
    :show-help-text="showHelpText"
    :full-width-content="fullWidthContent"
  >
    <template #field>
      <div ref="editor" class="w-full"></div>
    </template>
  </DefaultField>
</template>
