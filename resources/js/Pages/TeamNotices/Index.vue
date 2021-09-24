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
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
          <div
            class="rounded-lg focus-within:shadow hover:shadow"
            v-for="notice in notices"
            :key="notice.id"
          >
            <div class="p-4">
              <div class="flex justify-between align-middle mb-2">
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
                <button
                  class="
                    py-2
                    px-3
                    rounded-lg
                    flex flex-col
                    justify-center
                    active:shadow-inner
                    focus:shadow-inner
                    hover:shadow-inner
                  "
                  :class="{ tippy: notice.author?.id === $page.props.user?.id }"
                  :data-template="`notice-${notice.id}`"
                  v-if="notice.author?.id === $page.props.user?.id"
                >
                  <FontAwesomeIcon
                    :icon="icons.faEllipsisV"
                    class="text-gray-400"
                  />
                </button>
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
            <div
              class="hidden"
              :id="`notice-${notice.id}`"
              v-if="notice.author?.id === $page.props.user?.id"
            >
              <div class="-mx-2 -my-1">
                <!-- <button
                    class="hover:bg-gray-100 p-2 w-full text-left"
                    @click="console.log(`QR Code for notice #${notice.id}`)"
                  >
                    <FontAwesomeIcon :icon="icons.faQrcode" class="mr-2" />
                    Get QR Code
                  </button> -->
                <div
                  class="text-blue-500 hover:bg-blue-100 p-2 w-full text-left"
                >
                  <inertia-link :href="route('team-notices.edit', notice.id)">
                    <FontAwesomeIcon :icon="icons.faEdit" class="mr-2" />
                    Edit
                  </inertia-link>
                </div>
                <div class="text-red-500 hover:bg-red-100 p-2 w-full text-left">
                  <inertia-link :href="route('team-notices.delete', notice.id)">
                    <FontAwesomeIcon :icon="icons.faTrashAlt" class="mr-2" />
                    Delete
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
import { fetchTeamNoticesAsync } from "../../client";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
  faEdit,
  faEllipsisV,
  faQrcode,
  faTrashAlt,
} from "@fortawesome/free-solid-svg-icons";
import { delegate } from "tippy.js";

import "tippy.js/dist/tippy.css";
import "tippy.js/animations/scale.css";
import "tippy.js/themes/light-border.css";

export default {
  components: {
    AppLayout,
    FontAwesomeIcon,
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
    };
  },
  created: async function () {
    this.notices = await fetchTeamNoticesAsync(this.$page.props.user.current_team.id);
    delegate(".grid", {
      allowHTML: true,
      animation: "scale",
      arrow: false,
      interactive: true,
      placement: "left-start",
      target: ".tippy",
      theme: "light-border",
      trigger: "click",
      content(reference) {
        const id = reference.getAttribute("data-template");
        if (id === null) return;

        const template = document.getElementById(id);
        return template.innerHTML;
      },
    });
  }
};
</script>
