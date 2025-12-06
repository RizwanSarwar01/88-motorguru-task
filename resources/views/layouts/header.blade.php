<div
   class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-slate-200/60 bg-white/80 backdrop-blur-lg px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8"
   >
   <button
      type="button"
      class="-m-2.5 p-2.5 text-slate-700 hover:text-slate-900 hover:bg-slate-100 rounded-lg transition-colors lg:hidden"
      @click="sidebarOpen = true"
      >
      <span class="sr-only">Open sidebar</span>
      <svg
         class="h-6 w-6"
         fill="none"
         viewBox="0 0 24 24"
         stroke-width="1.5"
         stroke="currentColor"
         aria-hidden="true"
         >
         <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
      </svg>
   </button>
   <!-- Separator -->
   <div class="h-6 w-px bg-slate-200 lg:hidden" aria-hidden="true"></div>
   <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
      <form class="relative flex flex-1" action="#" method="GET">
         <label for="search-field" class="sr-only">Search</label>
         <svg
            class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400"
            viewBox="0 0 20 20"
            fill="currentColor"
            aria-hidden="true"
            data-slot="icon"
            >
            <path
               fill-rule="evenodd"
               d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z"
               clip-rule="evenodd"
               />
         </svg>
         <input
            id="search-field"
            class="block size-full border-0 py-2 pl-8 pr-4 text-slate-900 placeholder:text-slate-400 focus:ring-2 focus:ring-indigo-500 rounded-lg bg-slate-50 focus:bg-white transition-colors sm:text-sm"
            placeholder="Search..."
            type="search"
            name="search"
            />
      </form>
      <div class="flex items-center gap-x-4 lg:gap-x-6">
         <button
            type="button"
            class="-m-2.5 p-2.5 text-slate-400 hover:text-slate-600 hover:bg-slate-100 rounded-lg transition-colors"
            >
            <span class="sr-only">View notifications</span>
            <svg
               class="size-6"
               fill="none"
               viewBox="0 0 24 24"
               stroke-width="1.5"
               stroke="currentColor"
               aria-hidden="true"
               data-slot="icon"
               >
               <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"
                  />
            </svg>
         </button>
         <!-- Separator -->
         <div
            class="hidden lg:block lg:h-6 lg:w-px lg:bg-slate-200"
            aria-hidden="true"
            ></div>
         <!-- Profile dropdown -->
         <div class="relative">
            <button
               type="button"
               class="-m-1.5 flex items-center gap-3 p-1.5 rounded-lg hover:bg-slate-100 transition-colors"
               @click="profileMenuOpen = !profileMenuOpen"
               >
               <span class="sr-only">Open user menu</span>
               <div class="hidden lg:flex lg:flex-col lg:items-end">
                  <span class="text-sm font-semibold text-slate-900" aria-hidden="true">
                  {{ Auth::user()->name }}
                  </span>
                  <span class="text-xs text-slate-500">Administrator</span>
               </div>
               <img
                  class="h-9 w-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 ring-2 ring-white shadow-sm"
                  src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=6366f1&color=fff&size=128"
                  alt="{{ Auth::user()->name }}"
                  />
               <svg
                  class="hidden lg:block h-5 w-5 text-slate-400 transform transition-transform"
                  :class="{ 'rotate-180': profileMenuOpen }"
                  viewBox="0 0 20 20"
                  fill="currentColor"
                  aria-hidden="true"
                  >
                  <path
                     fill-rule="evenodd"
                     d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                     clip-rule="evenodd"
                     />
               </svg>
            </button>
            <div
               x-show="profileMenuOpen"
               x-transition:enter="transition ease-out duration-100 transform"
               x-transition:enter-start="opacity-0 scale-95"
               x-transition:enter-end="opacity-100 scale-100"
               x-transition:leave="transition ease-in duration-75 transform"
               x-transition:leave-start="opacity-100 scale-100"
               x-transition:leave-end="opacity-0 scale-95"
               class="absolute right-0 z-10 mt-2.5 w-48 origin-top-right rounded-lg bg-white py-2 shadow-xl ring-1 ring-slate-900/5 focus:outline-none"
               role="menu"
               aria-orientation="vertical"
               >
               <a
                  href="{{ route('profile.edit') }}"
                  class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 transition-colors"
                  role="menuitem"
                  >Your Profile</a>
               <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <a
                     href="{{ route('logout') }}"
                     class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors"
                     role="menuitem"
                     onclick="event.preventDefault(); this.closest('form').submit();"
                     >Sign Out</a>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
