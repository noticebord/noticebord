<template>
  <app-layout>
    <div class="py-12 bg-white">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div>
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
              <div>
                <!-- <jet-application-logo class="block h-12 w-auto" /> -->
              </div>

              <div class="mt-6 text-4xl">Welcome to Noticebord!</div>

              <div class="mt-6 text-gray-500">
                Noticebord is a simple yet powerful platform that enables you to
                post notices - which can be anything - to anyone, at any time.
                You don't even need an account to get started. We also let you
                make your notices anonymous, even if you are logged in. We
                respect free speech* over here at Noticebord.
              </div>
              <small class="text-xs text-gray-500 italic">
                *As long as content adheres to
                <a
                  href="#"
                  class="text-indigo-500 underline hover:text-indigo-600"
                >
                  community guidelines
                </a>
                . Noticebord reserves the right to remove any content deemed
                offensive or otherwise unfit for consumption.
              </small>
            </div>

            <div
              class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2"
            >
              <div class="p-6">
                <div class="flex items-center">
                  <FontAwesomeIcon :icon="icons.faWallet" size="lg" class="text-gray-400 mr-2" />
                  <div
                    class="ml-4 text-lg text-gray-600 leading-7 font-semibold"
                  >
                    <a :href="route('notices.index')">Free and public</a>
                  </div>
                </div>

                <div class="ml-12">
                  <div class="mt-2 text-sm text-gray-500">
                    Noticebord is a free service that lets you post notices both
                    publicly and privately to "teams" or even to one user in
                    particular. Posted notices can either be permanent or set to
                    self-destruct based on certain factors.
                  </div>

                  <a :href="route('notices.index')">
                    <div
                      class="
                        mt-3
                        flex
                        items-center
                        text-sm
                        font-semibold
                        text-indigo-700
                      "
                    >
                      <div>Explore public notices</div>
                      <FontAwesomeIcon :icon="icons.faArrowRight" class="text-indigo-500 ml-2" />
                    </div>
                  </a>
                </div>
              </div>

              <div
                class="p-6 border-t border-gray-200 md:border-t-0 md:border-l"
              >
                <div class="flex items-center">
                  <FontAwesomeIcon :icon="icons.faGlobeAfrica" size="lg" class="text-gray-400 mr-2" />
                  <div
                    class="ml-4 text-lg text-gray-600 leading-7 font-semibold"
                  >
                    <a href="#">Ubiquitous</a>
                  </div>
                </div>

                <div class="ml-12">
                  <div class="mt-2 text-sm text-gray-500">
                    Noticebord offers a number of offcial downloadable
                    applications for various mobile and desktop platforms. You
                    may even use Noticebord via the cross-platform command-line
                    interface or even our chatbot, accessible on a number of
                    chat applications.
                  </div>

                  <a href="#">
                    <div
                      class="
                        mt-3
                        flex
                        items-center
                        text-sm
                        font-semibold
                        text-indigo-700
                      "
                    >
                      <div>Check out the apps!</div>
                      <FontAwesomeIcon :icon="icons.faArrowRight" class="text-indigo-500 ml-2" />
                    </div>
                  </a>
                </div>
              </div>

              <div class="p-6 border-t border-gray-200">
                <div class="flex items-center">
                  <FontAwesomeIcon :icon="icons.faCode" size="lg" class="text-gray-400 mr-2" />
                  <div
                    class="ml-4 text-lg text-gray-600 leading-7 font-semibold"
                  >
                    <a href="#">Bring your own experience</a>
                  </div>
                </div>

                <div class="ml-12">
                  <div class="mt-2 text-sm text-gray-500">
                    Noticebord offers a free, public API - with support baked in
                    for every action our own platform offers - that lets you
                    build our own experience. In fact, each of our own
                    applications uses the very same API behind the scenes. Go
                    ahead, build something awesome!
                  </div>

                  <a href="#">
                    <div
                      class="
                        mt-3
                        flex
                        items-center
                        text-sm
                        font-semibold
                        text-indigo-700
                      "
                    >
                      <div>Go to API documentation!</div>
                      <FontAwesomeIcon :icon="icons.faArrowRight" class="text-indigo-500 ml-2" />
                    </div>
                  </a>
                </div>
              </div>

              <div class="p-6 border-t border-gray-200 md:border-l">
                <div class="flex items-center">
                  <FontAwesomeIcon :icon="icons.faCodeBranch" size="lg" class="text-gray-400 mr-2" />
                  <div
                    class="ml-4 text-lg text-gray-600 leading-7 font-semibold"
                  >
                    Open Source
                  </div>
                </div>

                <div class="ml-12">
                  <div class="mt-2 text-sm text-gray-500">
                    Noticebord, in its entirety - the web platform and all
                    official client applications - is completely open-source
                    under the MIT license. Found a bug you can fix? Thought of
                    an awesome feature you can contribute? Open a pull request
                    on GitHub! We're waiting.
                  </div>

                  <a href="#">
                    <div
                      class="
                        mt-3
                        flex
                        items-center
                        text-sm
                        font-semibold
                        text-indigo-700
                      "
                    >
                      <div>View source code on GitHub</div>
                      <FontAwesomeIcon :icon="icons.faArrowRight" class="text-indigo-500 ml-2" />
                    </div>
                  </a>
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
import AppLayout from "@/Layouts/AppLayout";
import JetApplicationLogo from "@/Jetstream/ApplicationLogo";
import Welcome from "@/Jetstream/Welcome";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faArrowRight, faCode, faCodeBranch, faGlobeAfrica, faWallet } from "@fortawesome/free-solid-svg-icons";

export default {
  data: function () {
    return {
      icons: {
        faArrowRight,
        faCode,
        faCodeBranch,
        faGlobeAfrica,
        faWallet
      },
    };
  },
  components: {
    AppLayout,
    FontAwesomeIcon,
    JetApplicationLogo,
    Welcome,
  },
};
</script>
