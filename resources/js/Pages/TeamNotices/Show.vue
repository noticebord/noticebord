<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold body-xl body-gray-800 leading-tight">
        {{ notice && notice.title }}
      </h2>
    </template>

    <div class="py-8 bg-white">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="prose mx-auto px-4 md:px-0">
          {{ notice && notice.body }}
        </div>

        <div class="flex w-full items-center px-4 py-4">
          <img
            class="w-10 h-10 rounded-full mr-4"
            :src="notice && notice.author.profile_photo_url"
            :alt="notice && notice.author.name"
          />
          <div class="flex-1 px-2">
            <inertia-link
              href="#"
              class="text-base font-bold md:text-xl leading-none mb-2"
            >
              {{ notice && notice.author.name }}
            </inertia-link>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import { fetchNoticeAsync } from "../../client";
import { assignDefaultAuthor } from "../../utils/notices";

export default {
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  components: {
    AppLayout,
  },
  data: function () {
    return {
      notice: null,
    };
  },
  created: async function () {
    const notice = await fetchNoticeAsync(this.id);
    this.notice = assignDefaultAuthor(notice);
  },
};
</script>
