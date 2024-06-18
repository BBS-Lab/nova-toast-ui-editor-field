<script lang="ts">
import { Viewer } from '@toast-ui/vue-editor'
import { defineComponent } from 'vue'
import HasEditor from '@/components/HasEditor'

export default defineComponent({
  mixins: [HasEditor],

  components: {
    Viewer,
  },

  props: {
    field: {
      type: Object,
      required: true,
    },
  },

  mounted() {
    this.viewer = true
    this.mountEditor(this.field.value || '')
  },
})
</script>

<template>
  <PanelItem :field="field">
    <template #value>
      <div ref="editor" class="w-full"></div>
    </template>
  </PanelItem>
</template>
