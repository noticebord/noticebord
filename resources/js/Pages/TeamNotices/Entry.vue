<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ id > 0 ? "Edit" : "Create" }} a Team Notice
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

          <div class="w-100 flex justify-center">
            <button
              :disabled="!notice.title || !notice.body"
              class="font-semibold rounded-lg px-3 py-2 border"
              :class="
                notice.title && notice.body
                  ? 'border-blue-700 text-blue-700 shadow hover:shadow-inner'
                  : 'border-gray-500 text-gray:400'
              "
              @click="saveTeamNotice"
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
  createTeamNoticeAsync,
  fetchTeamNoticeAsync,
  updateTeamNoticeAsync,
} from "../../client";
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
    return {
      notice: {
        title: "",
        body: ""
      },
    };
  },
  created: async function () {
    const teamId = this.$page.props.user.current_team.id;
    if (this.id > 0) this.notice = await fetchTeamNoticeAsync(teamId, this.id);
  },
  methods: {
    saveTeamNotice: async function () {
      const teamId = this.$page.props.user.current_team.id;
      const saveTask = this.id > 0
        ? updateTeamNoticeAsync(teamId, this.id, this.notice)
        : createTeamNoticeAsync(teamId, this.notice);
      const notice = await saveTask;
      Inertia.get(route("team-notices.show", notice.id));
    },
  },
};
</script>
