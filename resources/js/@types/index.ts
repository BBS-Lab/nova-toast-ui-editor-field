import {EditorType, PreviewStyle} from "@toast-ui/editor/types/editor";

export type EditorProps = {
  allowIframe: boolean

  options: {
    height: string
    hideModeSwitch: boolean
    initialEditType: EditorType
    language: string
    minHeight: string
    plugins: Array<PluginName>
    previewStyle: PreviewStyle
    toolbarItems: string[][]
    usageStatistics: boolean
    useCommandShortcut: boolean
  }

  useCloudinary: boolean
  cloudinary: CloudinaryProps
}

export type PluginName = 'chart' | 'codeSyntaxHighlight' | 'colorSyntax' | 'tableMergedCell' | 'uml'

export type CloudinaryProps = {
  string: string
  api_key: string
  username: string
  signature: string
  timestamp: number
  cloud_name: string
}

export type NovaField = {
  asHtml: boolean
  attribute: string
  component: string
  dependentComponentKey: string
  dependsOn?: any
  displayedAs?: any
  fullWidth: boolean
  helpText?: any
  indexName: string
  name: string
  nullable: boolean
  panel: string
  placeholder?: any
  prefixComponent: boolean
  readonly: boolean
  required: boolean
  sortable: boolean
  sortableUriKey: string
  stacked: boolean
  textAlign: string
  uniqueKey: string
  usesCustomizedDisplay: boolean
  validationKey: string
  value?: string
  visible: boolean
  editor: EditorProps
}

export type CloudinaryResponse = {
  assets: Array<CloudinaryAsset>
}

export type CloudinaryAsset = {
  public_id: string
  resource_type: string
  type: string
  format: string
  version: number
  url: string
  secure_url: string
  width: number
  height: number
  bytes: number
  duration: any
  created_at: string
  access_mode: string
  folder_id: string
  id: string
  folder: string
}

export type CloudinaryMediaLibrary = {
  show: () => void
}
