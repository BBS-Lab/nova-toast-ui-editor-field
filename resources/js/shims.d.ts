import type {Nova} from 'laravel-nova-types'
import {MediaLibrary} from 'MediaLibrary'
import {CloudinaryMediaLibrary} from '@/@types'

declare module '*.vue' {
  import type {DefineComponent} from 'vue'
  const component: DefineComponent<Record<string, unknown>, Record<string, unknown>, unknown>
  export default component
}

declare global {
  interface Window {
    Nova: Nova

    novaFileManagerEditor: PinturaIntegrationConfig
    LaravelNova: {
      HandlesValidationErrors: {
        errors: any
        hasError: boolean
        errorClass: string
      },
      DependentFormField: {
        value: any
      }
    }
    confetti: any

    cloudinary: {
      createMediaLibrary: (options: any, handlers: any) => CloudinaryMediaLibrary
      openMediaLibrary: (options: any, handlers: any) => any
    }
  }
}

declare module 'form-backend-validation' {
  interface Errors {
    [key: any]: any
  }
}
declare module '@vue/runtime-core' {
  interface ComponentCustomProperties {
    $cloudinaryMediaLibrary: MediaLibrary
  }
}
