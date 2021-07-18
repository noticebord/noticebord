<template>
  <app-layout>
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Create a Notice
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
              v-model="title"
            />
          </div>

          <div class="mb-2">
            <label for="text" class="font-semibold text-gray-500">Text</label>
            <textarea
              id="text"
              class="w-full rounded-lg"
              placeholder="This is a notice on Noticebord"
              rows="5"
              v-model="text"
            ></textarea>
          </div>

          <div class="w-100 flex justify-center">
            <button
              :disabled="!title || !text"
              class="font-semibold rounded-lg px-3 py-2"
              :class="
                title && text
                  ? 'border-blue-700 text-blue-700 shadow hover:shadow-inner'
                  : 'border-gray-500 text-gray:400'
              "
              @click="createNotice"
            >
              Create!
            </button>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import { createNoticeAsync } from "../../client/notices";
import { Inertia } from "@inertiajs/inertia";

export default {
  components: {
    AppLayout,
  },
  data: function () {
    return {
      title: "",
      text: "",
    };
  },
  methods: {
    createNotice: async function () {
      const notice = await createNoticeAsync(this.title, this.text);
      Inertia.get(route('notices.show', notice.id));
    },
  },
};
</script>
