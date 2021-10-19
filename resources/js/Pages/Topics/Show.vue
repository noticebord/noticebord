<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          #{{ topic?.name ?? 'topic' }}
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

              <div class="flex w-full items-center">
                <img
                  class="w-8 h-8 rounded-full mr-2"
                  :src="notice && notice.author.profile_photo_url"
                  :alt="notice && notice.author.name"
                />
                <div>
                  <inertia-link
                    href="#"
                    class="text-base text-gray-500 leading-none mb-2"
                  >
                    {{ notice && notice.author.name }}
                  </inertia-link>
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
import { fetchTopicAsync, fetchTopicNoticesAsync } from "../../client";
import { assignDefaultAuthor } from "../../utils/notices";

export default {
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  components: {
    AppLayout
  },
  data: function () {
    return {
      icons: {
        faEdit,
        faEllipsisV,
        faQrcode,
        faTrashAlt,
      },
      notices: [],
      topic: null
    };
  },
  created: async function () {
    this.topic = await fetchTopicAsync(this.id);
    const notices = await fetchTopicNoticesAsync(this.id);
    this.notices = notices.map((notice) => assignDefaultAuthor(notice));
  },
};
</script>
