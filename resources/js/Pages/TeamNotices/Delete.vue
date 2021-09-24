<template>
  <app-layout>
    <div class="py-8 bg-white flex flex-grow">
      <div class="m-auto p-4 shadow rounded-lg">
        <h4 class="text-xl font-semibold mb-2">
          <FontAwesomeIcon
            :icon="icons.faExclamationTriangle"
            class="text-yellow-500 mr-2"
          />
          Are you sure you want to delete this notice?
        </h4>
        <h5 class="text-lg text-gray-500 italic mb-4">
          CAUTION: This action is irreversible!
        </h5>
        <button
          class="
            p-2
            w-full
            rounded-lg
            text-red-500
            hover:bg-red-100
            hover:shadow-inner
          "
          @click="deleteNotice"
        >
          <FontAwesomeIcon :icon="icons.faTrashAlt" class="mr-2" />
          Delete
        </button>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import { deleteNoticeAsync } from "../../client";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
  faExclamationTriangle,
  faTrashAlt,
} from "@fortawesome/free-solid-svg-icons";
import { Inertia } from "@inertiajs/inertia";

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
        faExclamationTriangle,
        faTrashAlt,
      },
    };
  },
  methods: {
    deleteNotice: async function () {
      await deleteNoticeAsync(this.id);
      Inertia.get(route("notices.index"));
    },
  },
};
</script>
