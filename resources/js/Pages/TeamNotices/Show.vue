<template>
  <app-layout>
    <template #header>
      <h2 class="font-semibold body-xl body-gray-800 leading-tight">
        {{ notice?.title }}
      </h2>
    </template>

    <div class="py-8 bg-white">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="prose prose-indigo mx-auto px-4 md:px-0">
          <div
            class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-2"
            :class="{
              'lg:grid-cols-4': notice?.author.id === $page.props.user?.id,
            }"
          >
            <button
              class="rounded-full p-2 text-blue-500 hover:bg-blue-100"
              @click="qrcode"
            >
              <FontAwesomeIcon :icon="icons.faQrcode" class="mr-2" />
              QR Code
            </button>
            <button
              class="rounded-full p-2 text-green-500 hover:bg-green-100"
              @click="share"
            >
              <FontAwesomeIcon :icon="icons.faShareAlt" class="mr-2" />
              Share
            </button>
            <button
              class="rounded-full p-2 text-yellow-500 hover:bg-yellow-100"
              @click="editNotice"
              v-if="notice?.author.id === $page.props.user?.id"
            >
              <FontAwesomeIcon :icon="icons.faEdit" class="mr-2" />
              Edit
            </button>
            <button
              class="rounded-full p-2 text-red-500 hover:bg-red-100"
              @click="deleteNotice"
              v-if="notice?.author.id === $page.props.user?.id"
            >
              <FontAwesomeIcon :icon="icons.faTrashAlt" class="mr-2" />
              Delete
            </button>
          </div>

          <div id="body">
            {{ notice?.body }}
          </div>

          <div class="flex w-full items-center px-4 py-4" v-if="notice">
            <img
              class="w-10 h-10 rounded-full mr-4"
              :src="notice.author.profile_photo_url"
              :alt="notice.author.name"
            />
            <div class="flex-1 px-2 text-base md:text-xl blue">
              <inertia-link :href="route('profiles.show', notice.author.id)">
                {{ notice.author.name }}
              </inertia-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import { deleteTeamNoticeAsync, fetchTeamNoticeAsync } from "../../client";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
  faEdit,
  faQrcode,
  faShareAlt,
  faTrashAlt,
} from "@fortawesome/free-solid-svg-icons";
import { Inertia } from "@inertiajs/inertia";
import swal from "sweetalert2";
import QRCode from 'qrcode';

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
        faEdit,
        faQrcode,
        faShareAlt,
        faTrashAlt,
      },
      notice: null,
    };
  },
  created: async function () {
    const teamId = this.$page.props.user.current_team.id;
    this.notice = await fetchTeamNoticeAsync(teamId, this.id);
  },
  methods: {
    qrcode: async function () {
      const url = `https://noticebord.herokuapp.com/team/${this.notice.id}`;
      await swal.fire({
        title: "QR Code",
        text: "Scan this code to find this notice again.",
        imageUrl: await QRCode.toDataURL(url),
      });
    },
    share: async function () {
      if (navigator.canShare) {
        navigator
          .share({
            url: `https://noticebord.herokuapp.com/team/${this.notice.id}`,
            text: `Check out this team notice (${this.notice.title}) on Noticebord!`,
            title: `"${this.notice.title}" on Noticebord`,
          })
          .catch(console.error);
      } else {
        await swal.fire({
          icon: "error",
          title: "Error while sharing",
          text: "Your device does not seem to support this!",
        });
      }
    },
    editNotice: function () {
      Inertia.get(route("team-notices.edit", this.notice.id));
    },
    deleteNotice: async function () {
      const result = await swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ef4444",
        cancelButtonColor: "#3b82f6",
      });

      if (result.isConfirmed) {
        const teamId = this.$page.props.user.current_team.id;
        await deleteTeamNoticeAsync(teamId, this.notice.id);
        await swal.fire({
          icon: "success",
          title: "Deleted!",
          text: "The notice was deleted successfully",
        });
        Inertia.get(route("team-notices.index"));
      } else {
        await swal.fire({
          icon: "error",
          title: "Cancelled!",
          text: "The notice was not deleted.",
        });
      }
    },
  },
};
</script>
