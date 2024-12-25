<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
import {NButton, NDivider} from "naive-ui";
</script>

<template>
    <div class="flex flex-row items-center space-x-2">
        <h1
            class="text-2xl font-semibold text-brand dark:text-indigo-500/60"
        >
            {{$page.props.breadcrumbs.title}}
        </h1>
        <n-divider vertical/>
      <ul class="flex flex-row space-x-2 items-center">
        <li
          :key="index"
          v-for="(crumb, index) in $page.props.breadcrumbs.crumbs"
          class="flex flex-row space-x-2 items-center"
        >
          <template v-if="!crumb.active">
            <Link
              :href="crumb.url"
              class="flex flex-row space-x-1 items-center !text-brand-contrast"
            >
              <n-button quaternary size="tiny" type="primary">
                <template #icon v-if="crumb.name.toLowerCase() === 'home'">
                  <j-icon name="ph:house" :size="16" />
                </template>
                <span>{{ crumb.name }}</span>
              </n-button>
            </Link>
          </template>
          <span v-else>{{ crumb.name }}</span>
          <span v-if="index !== $page.props.breadcrumbs.crumbs.length - 1">/</span>
        </li>
      </ul>
    </div>
</template>

<style scoped>

</style>
