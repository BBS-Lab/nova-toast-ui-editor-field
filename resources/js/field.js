import VueCloudinaryMediaLibrary from 'vue-cloudinary-media-library-plugin'

Nova.booting((Vue, router, store) => {
  Vue.use(VueCloudinaryMediaLibrary)
  Vue.component('detail-nova-toast-ui-editor-field', require('./components/DetailField').default);
  Vue.component('form-nova-toast-ui-editor-field', require('./components/FormField').default);
})
