<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold body-xl body-gray-800 leading-tight">
        {{ notice?.title }}
      </h2>
    </template>

    <NoticeDisplay
      :notice="notice"
      :url="`https://noticebord.herokuapp.com/notices/${notice.id}`"
      @onEdit="editNotice"
      @onDelete="deleteNotice"
      v-if="notice"
      topics
    />
  </app-layout>
</template>

<script lang="ts">
import AppLayout from "../../Layouts/AppLayout.vue";
import NoticeDisplay from "../../Components/NoticeDisplay.vue";
import swal from "sweetalert2";
import { Inertia } from "@inertiajs/inertia";
import { defineComponent } from "@vue/runtime-core";
import { assignDefaultAuthor } from "../../utils/notices";
import { deleteNoticeAsync, fetchNoticeAsync } from "../../client";
import { Notice } from "../../client/models";

export default defineComponent({
  props: {
    id: {
      type: Number,
      required: true,
    },
  },
  components: {
    AppLayout,
    NoticeDisplay
  },
  data: function () {
    return {
      notice: null as Notice | null,
    };
  },
  created: async function () {
    const notice = await fetchNoticeAsync(this.id);
    this.notice = assignDefaultAuthor(notice);
  },
  methods: {
    editNotice: function () {
      if (this.notice) {
        // @ts-ignore
        Inertia.get(route("notices.edit", this.notice.id));
      }
    },
    deleteNotice: async function () {
      const result = await swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true
      });

      if (result.isConfirmed && this.notice) {
        await deleteNoticeAsync(this.notice.id);
        swal.fire({
          icon: "success",
          title: "Deleted!",
          text: "The notice was deleted successfully",
        });
        // @ts-ignore
        Inertia.get(route("notices.index"));
      } else {
        swal.fire({
          icon: "error",
          title: "Cancelled!",
          text: "The notice was not deleted.",
        });
      }
    },
  },
});
</script>
