<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Team Notices
        </h2>
        <inertia-link
          :href="route('team-notices.create')"
          class="
            text-base text-gray-500
            leading-none
            mb-2
            hover:text-indigo-500
            hover:underline
          "
        >
          Create a Team Notice
        </inertia-link>
      </div>
    </template>

    <div class="py-8 px-4 md:px-0 bg-white">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4" v-if="notices">
          <div
            class="rounded-lg focus-within:shadow hover:shadow"
            v-for="notice in notices.data"
            :key="notice.id"
          >
            <div class="p-4">
              <div class="flex align-middle mb-2">
                <inertia-link
                  :href="route('team-notices.show', notice.id)"
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

              <div
                class="
                  flex
                  w-full
                  items-center
                  text-base text-gray-500
                  leading-none
                "
                v-if="notice.author"
              >
                <img
                  class="w-8 h-8 rounded-full mr-2"
                  :src="notice.author.profile_photo_url"
                  :alt="notice.author.name"
                />
                <div>
                  <inertia-link
                    :href="route('profiles.show', notice.author.id)"
                    class="hover:text-indigo-500"
                  >
                    {{ notice.author.name }}
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

<script lang="ts">
// TODO: Find a way to resolve/ignore route() errors
import AppLayout from "../../Layouts/AppLayout.vue";
import { fetchTeamNoticesAsync } from "../../client";
import { Notice, Paginated } from '../../client/models';
import { defineComponent } from "vue";

export default defineComponent({
  components: {
    AppLayout,
  },
  data: function () {
    return {
      notices: null as Paginated<Notice[]> | null,
    };
  },
  created: async function () {
    this.notices = await fetchTeamNoticesAsync(
      // @ts-ignore
      this.$page.props.user.current_team.id
    );
  },
});
</script>
