import DetailField from './components/DetailField.vue'
import FormField from './components/FormField.vue'
import VueCloudinaryMediaLibrary from './MediaLibrary'
import '../css/field.css'

window.Nova.booting((app, store) => {
  app.use(VueCloudinaryMediaLibrary)
  app.component('detail-nova-toast-ui-editor-field', DetailField)
  app.component('form-nova-toast-ui-editor-field', FormField)
})
