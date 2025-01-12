<template>
  <suspense>
    <template #fallback>
      <n-skeleton v-if="loading" :width="24" :height="24" :sharp="false" size="medium" />
    </template>
    <template #default>
      <span :style="{ display: 'inline-block', width: sSize, height: sSize }">
        <Icon
          v-if="icon"
          v-bind="$attrs"
          :key="key"
          :icon="icon"
          :width="sSize"
          :height="sSize"
          :class="classes"
          :style="{
            width: sSize,
            color: iconColor,
            backgroundColor: color,
            borderRadius: borderRadius && `${borderRadius}px`
          }"
        />
      </span>
    </template>
  </suspense>
</template>

<script setup lang="ts">
import { Icon } from '@iconify/vue/dist/offline'
import { loadIcon } from '@iconify/vue'
import { computed, ref, watch } from 'vue'
import { NSkeleton } from 'naive-ui'

const props = defineProps<{
  name: string
  classes?: string
  size?: number | string
  color?: string
  borderRadius?: number
  iconColor?: string
}>()

const _sSize = computed(() => props.size ?? 20)
const sSize = computed(() =>
  typeof _sSize.value === 'string' ? _sSize.value : `${_sSize.value}px`
)
const sName = computed(() => props.name)
const icon = ref()
const loading = ref(true)
const key = ref(1)

const load = async (name: string) => {
  loading.value = true
  try {
    const res = await loadIcon(name)
    return res
  } catch (e) {
    console.error(`[jointer-iconify] failed to load icon ${name}`)
  } finally {
    loading.value = false
  }
}

load(sName.value).then((res) => {
  icon.value = res
})

watch(sName, (value) => {
  load(value).then((res) => {
    icon.value = res
  })
})
</script>
