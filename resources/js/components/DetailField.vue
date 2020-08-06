<template>
    <panel-item :field="field">
        <template slot="value">
            <viewer :initialValue="field.value" />
        </template>
    </panel-item>
</template>

<script>
import { Viewer } from '@toast-ui/vue-editor'

export default {
    components: {
        viewer: Viewer,
    },

    props: ['resource', 'resourceName', 'resourceId', 'field'],
}
</script>
