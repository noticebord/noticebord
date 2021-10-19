<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          User Profile {{ user && `- ${user.name}` }}
        </h2>
      </div>
    </template>

    <div class="px-4 md:px-0 bg-white">
      <div
        id="overview"
        class="p-6 sm:px-20 grid grid-cols-1 md:grid-cols-2 mb-2 bg-white"
      >
        <div class="flex flex-col items-center">
          <img
            :src="user?.profile_photo_url"
            :alt="user?.name"
            class="h-40 rounded-full mb-4"
          />
          <div class="flex items-center">
            <p class="font-semibold text-2xl">{{ user?.name }}</p>
            <button
              class="flex text-xl rounded-full p-2 text-blue-500 hover:shadow-inner ml-2"
              @click="qrcode"
            >
              <FontAwesomeIcon :icon="icons.faQrcode" />
            </button>
          </div>
        </div>
        <div>
          <p class="text-xl font-semibold py-2 border-b mb-2">Overview</p>
          <p class="mb-2">
            <span class="font-semibold">Joined on:</span>
            {{ user && new Date(user.created_at).toLocaleDateString() }}
          </p>

          <p class="mb-2">
            <span class="font-semibold">Notices Posted: </span>
            <span>{{ notices.length }}</span>
          </p>
          <p class="mb-2">
            <span class="font-semibold">Topics Posted In: </span>
            <span>{{ topics }}</span>
          </p>
          <p class="mb-2">
            <span class="font-semibold">Most Used Topics: </span>
            <span class="flex flex-wrap text-sm text-gray-500 py-2 gap-2">
              <span v-for="topic in frequent" :key="topic.id">
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
            </span>
          </p>
        </div>
      </div>

      <div class="flex mb-4" v-if="$page.props.user?.id == id">
        <button
          class="
            ml-auto
            px-3
            py-2
            rounded-l-lg
            hover:bg-blue-100
            hover:text-blue-500
          "
          :class="{
            'shadow-inner bg-blue-100 text-blue-500': tab === 'public',
          }"
          @click="tab = 'public'"
        >
          Public
        </button>
        <button
          class="
            mr-auto
            px-3
            py-2
            rounded-r-lg
            hover:bg-blue-100
            hover:text-blue-500
          "
          :class="{
            'shadow-inner bg-blue-100 text-blue-500': tab === 'private',
          }"
          @click="tab = 'private'"
        >
          Private
        </button>
      </div>

      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" v-show="tab === 'public'">
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
            </div>
          </div>
        </div>
      </div>

      <div
        class="max-w-7xl mx-auto sm:px-6 lg:px-8"
        v-if="$page.props.user?.id == id"
        v-show="tab === 'private'"
      >
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
          <div
            class="rounded-lg focus-within:shadow hover:shadow"
            v-for="notice in notes"
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
import {
  fetchUserAsync,
  fetchUserNoticesAsync,
  fetchUserNotesAsync,
} from "../client";
import { determineMostFrequent, generateTopicCounts } from "../utils/notices";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faQrcode } from "@fortawesome/free-solid-svg-icons";

export default {
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  components: {
    AppLayout,
    FontAwesomeIcon,
  },
  data: function () {
    return {
      icons: {
        faQrcode,
      },
      user: null,
      notices: [],
      notes: [],
      topics: 0,
      frequent: [],
      tab: "public",
    };
  },
  created: async function () {
    this.user = await fetchUserAsync(this.id);
    this.notices = await fetchUserNoticesAsync(this.id);

    if (this.$page.props.user?.id == this.id)
      this.notes = await fetchUserNotesAsync(this.id);

    const countMap = generateTopicCounts(this.notices);
    this.topics = countMap.size;
    this.frequent = determineMostFrequent(countMap);
  },
  methods: {
    qrcode: function () {
      alert("Work in progress!");
    },
  },
};
</script>
