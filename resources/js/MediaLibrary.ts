import { App, Plugin } from 'vue'
import { CloudinaryMediaLibrary, CloudinaryResponse } from '@/@types'

const addScript = () => {
  const script = document.createElement('script')
  script.type = 'text/javascript'
  script.src = 'https://media-library.cloudinary.com/global/all.js'

  document.head.appendChild(script)
}

export class MediaLibrary {
  widget?: CloudinaryMediaLibrary | null
  callback?: ((data: CloudinaryResponse) => void) | null

  constructor() {
    addScript()
    this.widget = null
    this.callback = null
  }

  init(options: any) {
    if (this.widget !== null) {
      return
    }

    this.widget = window.cloudinary.createMediaLibrary(options, {
      insertHandler: (data: CloudinaryResponse) => {
        if (this.callback !== null && this.callback !== undefined) {
          this.callback(data)
        }
      },
    })
  }

  show(callback: (data: CloudinaryResponse) => void) {
    if (this.widget === null || this.widget === undefined) {
      return
    }

    this.callback = callback
    this.widget.show()
  }
}

const VueCloudinaryMediaLibrary: Plugin = {
  install(app: App) {
    app.config.globalProperties.$cloudinaryMediaLibrary = new MediaLibrary()
  },
}

export default VueCloudinaryMediaLibrary
