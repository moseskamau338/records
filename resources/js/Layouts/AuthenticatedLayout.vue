<script setup lang="ts">
import {NLayout, NLayoutContent, NLayoutHeader, NLayoutSider} from "naive-ui";
</script>

<template>
<n-layout has-sider>
    <n-layout-sider :width="100" content-style="padding: 24px;" content-class="dark:bg-dark-900 !h-[100vh]">
      Handian Bridge
    </n-layout-sider>
    <n-layout-content content-class="dark:bg-slate-700">
    <n-layout-header class="p-4">
        Search etc
    </n-layout-header>
      <slot />
    </n-layout-content>
  </n-layout>
</template>
