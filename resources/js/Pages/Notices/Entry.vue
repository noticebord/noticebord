<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ id > 0 ? "Edit" : "Create" }} a Notice
        </h2>
      </div>
    </template>

    <div class="py-8 bg-white">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
          <div class="mb-2">
            <label for="title" class="font-semibold text-gray-500">Title</label>
            <input
              type="text"
              id="title"
              class="w-full rounded-lg"
              placeholder="Hi Everybody!"
              v-model.trim="notice.title"
            />
          </div>

          <div class="mb-2">
            <label for="body" class="font-semibold text-gray-500">Body</label>
            <textarea
              id="body"
              class="w-full rounded-lg"
              placeholder="This is a notice on Noticebord."
              rows="5"
              v-model.trim="notice.body"
            ></textarea>
          </div>

          <div class="mb-2">
            <input
              type="checkbox"
              id="anonymous"
              class="rounded-lg mr-1"
              :class="{ 'text-gray-500': !$page.props.user }"
              :disabled="!$page.props.user"
              :checked="notice.anonymous"
              @change="anonymousChange($event.target.checked)"
            />
            <label
              for="anonymous"
              class="font-semibold"
              :class="{ 'text-gray-500': !$page.props.user }"
            >
              Anonymous?
            </label>
          </div>

          <div class="mb-2">
            <input
              type="checkbox"
              id="public"
              class="rounded-lg mr-1"
              :class="{ 'text-gray-500': notice.anonymous }"
              :disabled="notice.anonymous"
              v-model="notice.public"
            />
            <label
              for="public"
              class="font-semibold"
              :class="{ 'text-gray-500': notice.anonymous }"
            >
              Public?
            </label>
          </div>

          <div class="w-100 flex justify-center">
            <button
              :disabled="!notice.title || !notice.body"
              class="font-semibold rounded-lg px-3 py-2 border"
              :class="
                notice.title && notice.body
                  ? 'border-blue-700 text-blue-700 shadow hover:shadow-inner'
                  : 'border-gray-500 text-gray:400'
              "
              @click="saveNotice"
            >
              Save!
            </button>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import {
  createNoticeAsync,
  fetchNoticeAsync,
  updateNoticeAsync,
} from "../../client/notices";
import { Inertia } from "@inertiajs/inertia";

export default {
  props: {
    id: {
      type: Number,
      required: false,
      default: -1,
    },
  },
  components: {
    AppLayout,
  },
  data: function () {
    const anonymous = !this.$page.props.user;
    return {
      notice: {
        title: "",
        body: "",
        anonymous: anonymous,
        public: anonymous,
      },
    };
  },
  created: async function () {
    if (this.id > 0) this.notice = await fetchNoticeAsync(this.id);
  },
  methods: {
    anonymousChange: function (checked) {
      if (checked) {
        this.notice.anonymous = true;
        this.notice.public = true;
        return;
      }

      this.notice.anonymous = false;
    },
    saveNotice: async function () {
      const saveTask = this.id > 0
        ? updateNoticeAsync(this.id, this.notice)
        : createNoticeAsync(this.notice);
      const notice = await saveTask;
      Inertia.get(route("notices.show", notice.id));
    },
  },
};
</script>
