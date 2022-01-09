<template>
    <div class="py-8 bg-white">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="prose prose-indigo mx-auto px-4 md:px-0" v-if="notice">
                <div
                    class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-2"
                    :class="{
                        'lg:grid-cols-4': isOwner,
                    }"
                >
                    <button
                        class="rounded-full p-2 text-blue-500 hover:bg-blue-100"
                        @click="qrcode"
                    >
                        <FontAwesomeIcon :icon="icons.faQrcode" class="mr-2" />QR Code
                    </button>
                    <button
                        class="rounded-full p-2 text-green-500 hover:bg-green-100"
                        @click="share"
                    >
                        <FontAwesomeIcon :icon="icons.faShareAlt" class="mr-2" />Share
                    </button>
                    <button
                        class="rounded-full p-2 text-yellow-500 hover:bg-yellow-100"
                        @click="$emit('onEdit')"
                        v-if="isOwner"
                    >
                        <FontAwesomeIcon :icon="icons.faEdit" class="mr-2" />Edit
                    </button>
                    <button
                        class="rounded-full p-2 text-red-500 hover:bg-red-100"
                        @click="$emit('onDelete')"
                        v-if="isOwner"
                    >
                        <FontAwesomeIcon :icon="icons.faTrashAlt" class="mr-2" />Delete
                    </button>
                </div>

                <div id="body" class="mb-4">{{ notice.body }}</div>

                <div class="flex flex-wrap text-sm text-gray-500 gap-2" v-if="topics">
                    <span>Topics:</span>
                    <span v-for="topic in notice.topics" :key="topic.id">
                        <inertia-link
                            :href="route('topics.show', topic.id)"
                            class="px-2 py-1 rounded-full hover:bg-indigo-100 hover:text-indigo-500 hover:underline"
                        >#{{ topic.name }}</inertia-link>
                    </span>
                </div>

                <div class="flex w-full items-center px-4" v-if="notice.author">
                    <img
                        class="w-10 h-10 rounded-full mr-4"
                        :src="notice.author.profile_photo_url"
                        :alt="notice.author.name"
                    />
                    <div class="flex-1 px-2 text-base md:text-xl">
                        <inertia-link
                            :href="route('profiles.show', notice.author.id)"
                            v-if="notice.author.id > 0"
                        >{{ notice.author.name }}</inertia-link>
                        <span v-else>{{ notice.author.name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
    faEdit,
    faQrcode,
    faShareAlt,
    faTrashAlt,
} from "@fortawesome/free-solid-svg-icons";
import { defineComponent, PropType } from "@vue/runtime-core";
import { Notice } from "../client/models";
import swal from "sweetalert2";
import QRCode from 'qrcode';

const onDelete = "onDelete";
const onEdit = "onEdit";


export default defineComponent({
    components: {
        FontAwesomeIcon,
    },
    props: {
        notice: {
            type: Object as PropType<Notice>,
            required: true,
        },
        url: {
            type: String,
            required: true,
        },
        topics: {
            type: Boolean,
            required: false,
            default: false,
        }
    },
    data: function () {
        return {
            icons: {
                faEdit,
                faQrcode,
                faShareAlt,
                faTrashAlt,
            },
        };
    },
    computed: {
        isOwner: function (): boolean {
            // @ts-ignore
            return !!this.notice.author && (this.notice.author.id === this.$page.props.user?.id);
        }
    },
    methods: {
        qrcode: async function () {
            await swal.fire({
                title: "QR Code",
                text: "Scan this code to find this notice again.",
                imageUrl: await QRCode.toDataURL(this.url),
            });
        },
        share: async function () {
            // @ts-ignore
            if (navigator.canShare()) {
                navigator.share({
                    url: this.url,
                    text: `Check out this notice (${this.notice.title}) on Noticebord!`,
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
    }
});
</script>