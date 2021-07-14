<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Notices</h2>
    </template>

    <div class="py-8 bg-white">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
          <div
            class="rounded-lg hover:shadow"
            v-for="notice in notices"
            :key="notice.id"
          >
            <div class="p-4">
              <div class="mb-2">
                <inertia-link
                  :href="route('notices.show', { noticeId: notice.id })"
                  class="text-xl font-semibold hover:text-indigo-500"
                >
                  {{ notice.title }}
                </inertia-link>
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
import { getNoticesAsync } from "../../client/notices";

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
    this.notices = await getNoticesAsync();
  },
};
</script>
