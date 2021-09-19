<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Noticebord Apps
        </h2>
      </div>
    </template>

    <div class="py-8 px-4 md:px-0 bg-white">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
          <div
            class="rounded-lg focus-within:shadow hover:shadow"
            v-for="(app, i) in apps"
            :key="i"
          >
            <div class="p-4">
                <h4 class="text-xl">{{ app.name }}</h4>
                <hr class="m-8" />
                <p>{{ app.description }}</p>
                <p>Runs on: {{ app.platforms.join(", ") }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
import { getApps } from "../utils/apps";

export default {
  components: {
    AppLayout,
  },
  data: function () {
    return {
      apps: [],
    };
  },
  created: function () {
    this.apps = getApps();
  },
};
</script>
