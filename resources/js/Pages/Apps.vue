<template>
  <app-layout>
    <div class="bg-white" style="scroll-snap-type: y mandatory; overflow: auto; height: calc(100vh - 4rem)"> 
      <div
        class="flex flex-col md:flex-row p-4"
        v-for="(app, i) in apps"
        style="scroll-snap-align: start; height: calc(100vh - 4rem)"
        :key="i"
        :class="{ 'md:flex-row-reverse bg-blue-400 text-white': i % 2 != 0 }"
      >
        <div class="p-4 md:w-1/2 flex">
          <img src="logo.svg" alt="Logo" class="w-40 h-40 md:w-80 md:h-80 m-auto" />
        </div>
        <div class="p-4 md:w-1/2 flex">
          <div class="m-auto">
            <h2 class="font-semibold text-3xl mb-2">{{ app.name }}</h2>
            <p
              class="text-xl mb-2"
              :class="i % 2 != 0 ? 'text-gray-200' : 'text-gray-500'"
            >
              {{ app.description }}
            </p>
            <p class="text-lg italic mb-4">
              Runs on: {{ app.platforms.join(", ") }}
            </p>
            <button
              class="
                font-semibold
                text-lg
                p-4
                rounded-full
                border-2
                duration-300
              "
              :class="
                i % 2 != 0
                  ? 'bg-white text-blue-500 border-white hover:bg-blue-400 hover:text-white'
                  : 'bg-blue-400 text-white border-blue-400 hover:bg-white hover:text-blue-400'
              "
            >
              {{ app.cta }}
            </button>
          </div>
        </div>
      </div>
      <div class="p-8 bg-blue-400" style="scroll-snap-align: start; height: calc(100vh - 4rem)">
        <h2 class="text-3xl text-white text-center mb-8">
          Client Libraries
        </h2>
        <p class="text-xl text-white text-center mb-8">We curently provide {{ libraries.length }} official wrapper libraries for the Noticebord API, as well as Swagger/OpenAPI documentation and a Postman collection.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
          <div
            class="p-4 bg-white rounded-lg shadow-lg"
            v-for="(library, i) in libraries"
            :key="i"
          >
            <h3
              class="font-semibold text-xl mb-2"
              :style="{ color: library.color }"
            >
              <i class="colored" :class="library.icon"></i>
              {{ library.platform }}
            </h3>
            <pre
              class="
                bg-gray-900
                text-white
                p-2
                rounded-lg
                mb-2
                overflow-x-scroll
              "
              >{{ library.command }}</pre
            >
            <div>
              <a
                :href="library.package"
                target="_blank"
                class="text-lg text-green-500 hover:underline"
              >
                <i class="colored" :class="library.registryIcon"></i>
                 <span :style="{ color: library.registryColor }">
                  Get it on {{ library.registry }}
                </span>
              </a>
            </div>
            <div>
              <a
                :href="library.source"
                target="_blank"
                class="text-lg hover:underline"
              >
                <FontAwesomeIcon :icon="icons.faGithub" class="mr-1" />
                View source on GitHub
              </a>
            </div>
          </div>
                   
          <div class="p-4 bg-white rounded-lg shadow-lg flex flex-col justify-center items-center text-blue-300">
            <FontAwesomeIcon
                  :icon="icons.faQuestion"
                  class="text-4xl mb-2"
                />
                <p class="text-xl">Your library</p>
          </div>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "../Layouts/AppLayout.vue";
import { getApps, getLibraries } from "../utils/apps";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faQuestion } from "@fortawesome/free-solid-svg-icons";
import { faGithub } from "@fortawesome/free-brands-svg-icons";

export default {
  components: {
    AppLayout,
    FontAwesomeIcon,
  },
  data: function () {
    return {
      apps: [],
      libraries: [],
      icons: {
        faQuestion,
        faGithub,
      },
    };
  },
  created: function () {
    this.apps = getApps();
    this.libraries = getLibraries();
  },
};
</script>
