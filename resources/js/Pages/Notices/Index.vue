<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Notices
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
            v-for="notice in notices"
            :key="notice.id"
          >
            <div class="p-4">
              <div class="flex align-middle mb-2">
                <inertia-link
                  :href="route('notices.show', notice.id)"
                  class="
                    text-xl
                    font-semibold
                    hover:text-indigo-500
                    flex flex-col
                    justify-center
                  "
                >
                  {{ notice.title }}
                </inertia-link>
              </div>

              <div class="flex flex-wrap text-sm text-gray-500 mb-2 gap-2">
                <span v-for="topic in notice.topics" :key="topic.id">
                  <inertia-link
                    :href="route('topics.show', topic.id)"
                    class="
                      px-2
                      py-1
                      rounded-full
                      hover:bg-indigo-100
                      hover:text-indigo-500
                      hover:underline
                    "
                  >
                    #{{ topic.name }}
                  </inertia-link>
                </span>
              </div>

              <div
                class="
                  flex
                  w-full
                  items-center
                  text-base text-gray-500
                  leading-none
                "
              >
                <img
                  class="w-8 h-8 rounded-full mr-2"
                  :src="notice?.author.profile_photo_url"
                  :alt="notice?.author.name"
                />
                <div>
                  <inertia-link
                    :href="route('profiles.show', notice?.author.id)"
                    class="hover:text-indigo-500"
                    v-if="notice?.author.id > 0"
                  >
                    {{ notice?.author.name }}
                  </inertia-link>
                  <span v-else>
                    {{ notice?.author.name }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import { fetchNoticesAsync } from "../../client";
import { assignDefaultAuthor } from "../../utils/notices";

export default {
  components: {
    AppLayout,
  },
  data: function () {
    return {
      notices: [],
    };
  },
  created: async function () {
    const notices = await fetchNoticesAsync();
    this.notices = notices.map((notice) => assignDefaultAuthor(notice));
  },
};
</script>
