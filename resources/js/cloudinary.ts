import { PluginInfo } from '@toast-ui/editor/types'
import { PopupOptions, ToolbarStateKeys } from '@toast-ui/editor/types/ui'
export default function (): PluginInfo {
  return {
    toolbarItems: [
      {
        groupIndex: 1,
        itemIndex: 1,
        item: {
          name: 'Cloudinary',
          tooltip: 'Open Cloudinary media library',
          // className?: string;
          // command?: string;
          // text?: string;
          // style?: Record<string, any>;
          // popup?: PopupOptions;
          // state?: ToolbarStateKeys;
        },
      },
    ],
  }
}
