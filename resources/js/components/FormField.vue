<template>
    <default-field :field="field" :errors="errors" :full-width-content="true">
        <template slot="field">
            <editor
                :id="field.name"
                :class="errorClasses"
                :initialValue="field.value"
                :initialEditType="editorConfig.initialEditType"
                :previewStyle="editorConfig.previewStyle"
                :height="editorConfig.height"
                :options="editorConfig.options"
                @change="editorChange"
                @load="editorLoad"
                ref="editor"
            />
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'
import { Editor } from '@toast-ui/vue-editor'
import HasEditor from './HasEditor'

export default {
    components: {
        editor: Editor,
    },

    mixins: [FormField, HandlesValidationErrors, HasEditor],

    props: ['resourceName', 'resourceId', 'field'],

    created() {
      this.compileEditorOptions(this.field.editor)
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            formData.append(this.field.attribute, this.value || '')
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value
        },
    },
}
</script>
