<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Topics
        </h2>
        <inertia-link
          :href="route('notices.create')"
          class="
            text-base text-gray-500
            leading-none
            mb-2
            hover:text-indigo-500
            hover:underline
          "
        >
          Create a Notice
        </inertia-link>
      </div>
    </template>

    <div class="py-8 px-4 md:px-0 bg-white">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
          <div
            class="rounded-lg focus-within:shadow hover:shadow"
            v-for="topic in topics"
            :key="topic.id"
          >
            <div class="p-4">
              <inertia-link
                :href="route('topics.show', topic.id)"
                class="
                  text-3xl
                  font-light
                  hover:text-indigo-500
                  flex flex-col
                  justify-center
                  mb-2
                "
              >
                #{{ topic.name }}
              </inertia-link>

              <div class="text-gray-500">
                <span class="font-bold">{{ topic.count }}</span>
                {{ topic.count === 1 ? "notice" : "notices" }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script lang="ts">
// TODO: Find a way to resolve/ignore route() errors
import AppLayout from "../../Layouts/AppLayout.vue";
import { fetchTopicsAsync } from "../../client";
import { defineComponent } from "@vue/runtime-core";
import { Topic } from "../../client/models";

export default defineComponent({
  components: {
    AppLayout
  },
  data: function () {
    return {
      topics: [] as Topic[]
    };
  },
  created: async function () {
    this.topics = await fetchTopicsAsync();
  },
});
</script>
