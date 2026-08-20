@php
    $avatarColors = ['from-indigo-500 to-purple-500', 'from-rose-500 to-orange-500', 'from-emerald-500 to-teal-500', 'from-amber-500 to-pink-500'];
@endphp
<x-site-layout>
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-gray-900 text-white">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/50 via-gray-900 to-gray-900"></div>
        <div class="absolute -top-24 -right-24 h-96 w-96 rounded-full bg-indigo-600/20 blur-3xl"></div>
        <div class="absolute -bottom-32 -left-24 h-96 w-96 rounded-full bg-purple-600/10 blur-3xl"></div>

        <div class="relative max-w-6xl mx-auto px-6 py-24 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div class="text-center md:text-left">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-600/20 text-indigo-300 text-xs font-semibold tracking-wide uppercase ring-1 ring-indigo-500/30">
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" /></svg>
                    Shape your body well
                </span>
                <h1 class="mt-4 text-4xl sm:text-5xl font-extrabold tracking-tight">{{ $home['hero_heading'] ?: 'Train Hard. Get Results.' }}</h1>
                @if ($home['hero_subheading'])
                    <p class="mt-4 text-lg text-gray-300 max-w-2xl">{{ $home['hero_subheading'] }}</p>
                @endif

                <div class="mt-8 flex flex-wrap justify-center md:justify-start gap-3">
                    @if ($home['hero_button_label'] && $home['hero_button_url'])
                        <a href="{{ $home['hero_button_url'] }}"
                            class="inline-block px-6 py-3 bg-indigo-600 text-white text-sm font-semibold rounded-lg shadow-lg shadow-indigo-900/40 hover:bg-indigo-500 transition">
                            {{ $home['hero_button_label'] }}
                        </a>
                    @endif
                    <a href="{{ route('membership-plans') }}"
                        class="inline-block px-6 py-3 bg-white/5 text-white text-sm font-semibold rounded-lg ring-1 ring-white/20 hover:bg-white/10 transition">
                        See Plans
                    </a>
                </div>

                <div class="mt-12 grid grid-cols-3 gap-6 max-w-md mx-auto md:mx-0">
                    <div x-data="countUp(10)" x-init="start()">
                        <div class="text-2xl font-extrabold text-white"><span x-text="value"></span>+</div>
                        <div class="text-xs text-gray-400 mt-1">Years Experience</div>
                    </div>
                    <div x-data="countUp({{ $plans->count() }})" x-init="start()">
                        <div class="text-2xl font-extrabold text-white"><span x-text="value"></span>+</div>
                        <div class="text-xs text-gray-400 mt-1">Membership Plans</div>
                    </div>
                    <div>
                        <div class="text-2xl font-extrabold text-white">24/7</div>
                        <div class="text-xs text-gray-400 mt-1">Gym Access</div>
                    </div>
                </div>
            </div>
            @if ($home['hero_image_path'])
                <img src="{{ Storage::disk('public')->url($home['hero_image_path']) }}" class="rounded-2xl shadow-2xl w-full ring-1 ring-white/10">
            @else
                <div class="hidden md:flex aspect-[4/3] rounded-2xl bg-gradient-to-br from-indigo-800/50 to-gray-800 ring-1 ring-white/10 items-center justify-center">
                    <svg class="h-24 w-24 text-white/20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0C20.25 4.097 16.556 2.25 12 2.25S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                    </svg>
                </div>
            @endif
        </div>
    </section>

    {{-- Intro --}}
    @if ($home['intro_heading'] || $home['intro_text'])
        <section class="max-w-4xl mx-auto px-6 py-16 text-center">
            @if ($home['intro_heading'])
                <h2 class="text-2xl font-bold">{{ $home['intro_heading'] }}</h2>
            @endif
            @if ($home['intro_text'])
                <p class="mt-4 text-gray-600">{{ $home['intro_text'] }}</p>
            @endif
        </section>
    @endif

    {{-- Why train with us --}}
    <section class="bg-white border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-6 py-20">
            <div class="text-center max-w-2xl mx-auto">
                <span class="text-xs font-semibold tracking-widest text-indigo-600 uppercase">What we offer</span>
                <h2 class="mt-2 text-3xl font-extrabold">We Care About What We Offer</h2>
                <p class="mt-3 text-gray-600">Everything you need to build a consistent, sustainable fitness routine.</p>
            </div>
            <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-8">
                @foreach ([
                    ['title' => 'Regular Exercise', 'text' => 'Structured programs that build consistency, not just intensity.', 'color' => 'bg-indigo-600', 'icon' => 'fire'],
                    ['title' => 'Expert Coaching', 'text' => 'Certified trainers guide every plan, from beginner to advanced.', 'color' => 'bg-rose-500', 'icon' => 'users'],
                    ['title' => 'Modern Equipment', 'text' => 'A fully equipped floor, kept in top condition, always available.', 'color' => 'bg-emerald-500', 'icon' => 'bolt'],
                ] as $offer)
                    <div class="group rounded-2xl border border-gray-100 p-8 text-center shadow-sm hover:shadow-xl hover:-translate-y-1 transition">
                        <div class="mx-auto h-14 w-14 rounded-2xl {{ $offer['color'] }} text-white flex items-center justify-center shadow-lg">
                            @if ($offer['icon'] === 'fire')
                                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.362 5.214A8.252 8.252 0 0112 21 8.25 8.25 0 016.038 7.048 8.287 8.287 0 009 9.6a8.983 8.983 0 013.361-6.867 8.21 8.21 0 003 2.48z" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 18a3.75 3.75 0 00.495-7.467 5.99 5.99 0 00-1.925 3.546 5.974 5.974 0 01-2.133-1.001A3.75 3.75 0 0012 18z" /></svg>
                            @elseif ($offer['icon'] === 'users')
                                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" /></svg>
                            @else
                                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z" /></svg>
                            @endif
                        </div>
                        <h3 class="mt-5 font-semibold text-lg">{{ $offer['title'] }}</h3>
                        <p class="mt-2 text-sm text-gray-600 leading-relaxed">{{ $offer['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- BMI calculator --}}
    <section class="bg-gray-50 border-t border-gray-100" x-data="{
            height: '',
            weight: '',
            bmi: null,
            category: '',
            categoryColor: '',
            calculate() {
                const h = parseFloat(this.height) / 100;
                const w = parseFloat(this.weight);
                if (!h || !w || h <= 0 || w <= 0) {
                    this.bmi = null;
                    this.category = '';
                    return;
                }
                this.bmi = (w / (h * h)).toFixed(1);
                if (this.bmi < 18.5) { this.category = 'Underweight'; this.categoryColor = 'text-amber-500'; }
                else if (this.bmi < 25) { this.category = 'Normal'; this.categoryColor = 'text-emerald-500'; }
                else if (this.bmi < 30) { this.category = 'Overweight'; this.categoryColor = 'text-orange-500'; }
                else { this.category = 'Obese'; this.categoryColor = 'text-rose-500'; }
            }
        }">
        <div class="max-w-5xl mx-auto px-6 py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center bg-white rounded-2xl border border-gray-100 shadow-sm p-8 sm:p-12">
                <div>
                    <span class="text-xs font-semibold tracking-widest text-indigo-600 uppercase">Free tool</span>
                    <h2 class="mt-2 text-3xl font-extrabold">Calculate Your Body Mass Index</h2>
                    <p class="mt-3 text-gray-600">Get a quick read on where you stand, then talk to a coach about a plan built for your goal.</p>

                    <form @submit.prevent="calculate" class="mt-8 space-y-4">
                        <div>
                            <label for="bmi_height" class="block text-sm font-medium text-gray-700">Height (cm)</label>
                            <input id="bmi_height" type="number" min="0" step="0.1" x-model="height"
                                class="mt-1.5 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                placeholder="e.g. 175">
                        </div>
                        <div>
                            <label for="bmi_weight" class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                            <input id="bmi_weight" type="number" min="0" step="0.1" x-model="weight"
                                class="mt-1.5 w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                placeholder="e.g. 70">
                        </div>
                        <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-500 transition">
                            Calculate BMI
                        </button>
                    </form>
                </div>

                <div class="flex items-center justify-center">
                    <div class="w-full aspect-square max-w-xs rounded-2xl bg-gray-50 border border-gray-100 flex flex-col items-center justify-center text-center p-6">
                        <div class="h-24 w-24 transition-colors duration-500" :class="bmi === null ? 'text-gray-300' : categoryColor">
                            {{-- Normal / default: healthicons.org "body" (CC0) --}}
                            <svg x-show="category !== 'Underweight' &amp;&amp; category !== 'Overweight' &amp;&amp; category !== 'Obese'" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 13C26.4853 13 28.5 10.9853 28.5 8.5C28.5 6.01472 26.4853 4 24 4C21.5147 4 19.5 6.01472 19.5 8.5C19.5 10.9853 21.5147 13 24 13ZM37.9201 15.4404C38.2292 16.5008 37.6201 17.6111 36.5596 17.9201C34.1842 18.6124 32.0379 19.1337 30 19.4812V30.9944L30 31V42C30 43.0693 29.1589 43.9495 28.0906 43.998C27.0224 44.0464 26.105 43.246 26.0082 42.1811L25.0082 31.1811C25.0027 31.1206 25 31.0602 25 31H23C23 31.0602 22.9973 31.1206 22.9918 31.1811L21.9918 42.1811C21.895 43.246 20.9776 44.0464 19.9094 43.998C18.8412 43.9495 18 43.0693 18 42L18 19.4443C15.9674 19.0938 13.8288 18.583 11.4653 17.9272C10.4009 17.6319 9.7775 16.5296 10.0728 15.4653C10.3682 14.4009 11.4704 13.7775 12.5348 14.0728C17.1431 15.3515 20.6058 15.9845 24.0087 15.9997C27.4047 16.0149 30.8587 15.4152 35.4404 14.0799C36.5009 13.7708 37.6111 14.3799 37.9201 15.4404Z" fill="currentColor" />
                            </svg>

                            {{-- Underweight: healthicons.org "underweight" (CC0) --}}
                            <svg x-show="category === 'Underweight'" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M28.5 8.5C28.5 10.9853 26.4853 13 24 13C21.5147 13 19.5 10.9853 19.5 8.5C19.5 6.01472 21.5147 4 24 4C26.4853 4 28.5 6.01472 28.5 8.5Z" fill="currentColor" />
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M32.2683 27.4758C33.0834 27.3276 33.624 26.5467 33.4758 25.7317C33.424 25.4468 33.3555 25.0102 33.2739 24.4905C33.1133 23.4681 32.9022 22.1233 32.6682 20.9753C32.485 20.0769 32.2641 19.1627 31.995 18.4296C31.862 18.0672 31.6938 17.683 31.4744 17.351C31.2847 17.0638 30.8892 16.5556 30.2083 16.3722C25.7676 15.1762 22.2083 15.2312 17.7953 16.4082C17.1154 16.5895 16.719 17.0946 16.528 17.3818C16.3079 17.7129 16.1392 18.096 16.006 18.4568C15.7365 19.1869 15.5154 20.097 15.3322 20.9912C15.0966 22.1411 14.8852 23.483 14.7246 24.5029C14.6439 25.0156 14.576 25.447 14.5242 25.7317C14.376 26.5467 14.9166 27.3276 15.7317 27.4758C16.5468 27.624 17.3276 27.0834 17.4758 26.2683C17.5529 25.8443 17.6321 25.3372 17.7196 24.7773C17.869 23.8201 18.0426 22.7085 18.2711 21.5934C18.446 20.7398 18.6312 20.0082 18.8204 19.4957C18.8645 19.3763 18.9038 19.2826 18.937 19.2108C19.3445 19.1073 19.7426 19.0149 20.1334 18.9337L21 25L19.5 30.5V42.5C19.5 43.3284 20.1716 44 21 44C21.8284 44 22.5 43.3284 22.5 42.5V30.5H25.5V42.5C25.5 43.3284 26.1716 44 27 44C27.8284 44 28.5 43.3284 28.5 42.5V30.5L27 25L27.8716 18.8987C28.2601 18.978 28.6556 19.0692 29.0602 19.1725C29.0939 19.2455 29.1339 19.3412 29.1787 19.4632C29.3683 19.9798 29.5537 20.7164 29.7286 21.5746C29.9566 22.6928 30.1291 23.8014 30.2778 24.7575C30.3661 25.3247 30.446 25.8383 30.5242 26.2683C30.6724 27.0834 31.4533 27.624 32.2683 27.4758Z" fill="currentColor" />
                            </svg>

                            {{-- Overweight / Obese: healthicons.org "overweight" (CC0). Obese scales it up
                                 for emphasis since healthicons has no distinct fourth tier. --}}
                            <svg x-show="category === 'Overweight' || category === 'Obese'"
                                :class="category === 'Obese' ? 'scale-110' : ''"
                                class="transition-transform duration-500" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M24 13C26.4853 13 28.5 10.9853 28.5 8.5C28.5 6.01472 26.4853 4 24 4C21.5147 4 19.5 6.01472 19.5 8.5C19.5 10.9853 21.5147 13 24 13ZM36.5596 17.0799C37.6201 17.3889 38.2292 18.4992 37.9201 19.5596C37.6111 20.6201 36.5009 21.2292 35.4404 20.9201C34.3489 20.602 33.3213 20.3256 32.3433 20.0894L32.3912 20.2384C33.6992 24.3151 35.0282 28.4572 32.8172 32.0289L30.4503 42.4432C30.2246 43.4362 29.2889 44.1011 28.277 43.9875C27.2651 43.874 26.5 43.0183 26.5 42V35.9302C25.7042 36 24.8762 36 24 36C23.3058 36 22.6417 36 22 35.9653V42C22 43.0183 21.2349 43.874 20.223 43.9875C19.2111 44.1011 18.2754 43.4362 18.0497 42.4432L15.9101 33.0287C12.7197 29.2431 14.1769 24.7016 15.6089 20.2384L15.6458 20.1234C14.6639 20.355 13.6318 20.6228 12.5348 20.9272C11.4704 21.2225 10.3682 20.5991 10.0728 19.5347C9.7775 18.4704 10.4009 17.3681 11.4653 17.0728C16.2296 15.7508 20.0803 15.0178 23.9908 15.0003C27.9083 14.9828 31.768 15.6834 36.5596 17.0799Z" fill="currentColor" />
                            </svg>
                        </div>

                        <template x-if="bmi === null">
                            <p class="mt-4 text-sm text-gray-400">Enter your height and weight to see your BMI.</p>
                        </template>
                        <template x-if="bmi !== null">
                            <div class="mt-4">
                                <div class="text-5xl font-extrabold" x-text="bmi"></div>
                                <div class="mt-2 text-sm font-semibold" :class="categoryColor" x-text="category"></div>
                                <div class="mt-4 text-xs text-gray-400">BMI = weight (kg) / height (m)&sup2;</div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats band --}}
    <section class="bg-indigo-600">
        <div class="max-w-6xl mx-auto px-6 py-12 grid grid-cols-2 sm:grid-cols-4 gap-8 text-center text-white">
            @foreach ([
                ['value' => '1,200+', 'label' => 'Active Members'],
                ['value' => '15+', 'label' => 'Expert Trainers'],
                ['value' => '30+', 'label' => 'Weekly Classes'],
                ['value' => '98%', 'label' => 'Member Satisfaction'],
            ] as $stat)
                <div>
                    <div class="text-3xl font-extrabold">{{ $stat['value'] }}</div>
                    <div class="mt-1 text-xs uppercase tracking-wide text-indigo-100">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Membership plans --}}
    @if ($plans->isNotEmpty())
        <section class="bg-gray-50 border-t border-gray-100">
            <div class="max-w-6xl mx-auto px-6 py-20">
                <div class="text-center max-w-2xl mx-auto">
                    <span class="text-xs font-semibold tracking-widest text-indigo-600 uppercase">Pricing</span>
                    <h2 class="mt-2 text-3xl font-extrabold">Choose the Perfect Plan for You</h2>
                    <p class="mt-3 text-gray-600">Simple pricing, no hidden fees. Cancel anytime.</p>
                </div>
                <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 items-start">
                    @foreach ($plans as $index => $plan)
                        @php $featured = $index === 1 && $plans->count() > 1; @endphp
                        <div class="relative rounded-2xl p-8 flex flex-col {{ $featured ? 'bg-gray-900 text-white shadow-2xl lg:-translate-y-3 ring-1 ring-indigo-500/40' : 'bg-white border border-gray-100 shadow-sm' }}">
                            @if ($featured)
                                <span class="absolute -top-3 left-1/2 -translate-x-1/2 px-3 py-1 rounded-full bg-indigo-600 text-white text-[11px] font-semibold uppercase tracking-wide shadow">
                                    Most Popular
                                </span>
                            @endif
                            <div class="text-lg font-bold {{ $featured ? 'text-white' : '' }}">{{ $plan->name }}</div>
                            <div class="mt-3">
                                <span class="text-3xl font-extrabold {{ $featured ? 'text-white' : 'text-indigo-600' }}">${{ number_format($plan->price, 2) }}</span>
                                <span class="text-xs {{ $featured ? 'text-gray-400' : 'text-gray-500' }}">/ {{ str_replace('_', ' ', $plan->billing_interval) }}</span>
                            </div>
                            @if ($plan->short_description)
                                <p class="mt-3 text-sm {{ $featured ? 'text-gray-300' : 'text-gray-600' }}">{{ $plan->short_description }}</p>
                            @endif
                            @if (!empty($plan->features))
                                <ul class="mt-5 space-y-2.5 text-sm {{ $featured ? 'text-gray-200' : 'text-gray-600' }} flex-1">
                                    @foreach ($plan->features as $feature)
                                        <li class="flex items-start gap-2">
                                            <svg class="mt-0.5 h-4 w-4 flex-shrink-0 {{ $featured ? 'text-indigo-400' : 'text-indigo-600' }}" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" /></svg>
                                            <span>{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <a href="{{ route('contact') }}"
                                class="mt-6 inline-block text-center px-4 py-2.5 rounded-lg text-sm font-semibold transition {{ $featured ? 'bg-indigo-600 text-white hover:bg-indigo-500' : 'border border-indigo-600 text-indigo-600 hover:bg-indigo-600 hover:text-white' }}">
                                Get Started
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Trainers --}}
    <section class="bg-white border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-6 py-20">
            <div class="text-center max-w-2xl mx-auto">
                <span class="text-xs font-semibold tracking-widest text-indigo-600 uppercase">Our team</span>
                <h2 class="mt-2 text-3xl font-extrabold">Our Experienced Trainers</h2>
                <p class="mt-3 text-gray-600">A coaching team invested in every member's progress.</p>
            </div>
            <div class="mt-12 grid grid-cols-2 sm:grid-cols-4 gap-8">
                @foreach ([['Alex Carter', 'Strength Coach'], ['Jordan Lee', 'HIIT Coach'], ['Sam Rivera', 'Yoga Instructor'], ['Taylor Brooks', 'Nutrition Coach']] as $i => $trainer)
                    <div class="text-center">
                        <div class="mx-auto h-24 w-24 rounded-full bg-gradient-to-br {{ $avatarColors[$i % count($avatarColors)] }} text-white flex items-center justify-center text-2xl font-bold shadow-lg ring-4 ring-white">
                            {{ collect(explode(' ', $trainer[0]))->map(fn ($p) => $p[0])->implode('') }}
                        </div>
                        <div class="mt-4 font-semibold text-sm">{{ $trainer[0] }}</div>
                        <div class="text-xs text-indigo-600 mt-0.5">{{ $trainer[1] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="bg-gray-50 border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-6 py-20">
            <div class="text-center max-w-2xl mx-auto">
                <span class="text-xs font-semibold tracking-widest text-indigo-600 uppercase">Testimonials</span>
                <h2 class="mt-2 text-3xl font-extrabold">What Our Members Say</h2>
            </div>
            <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-8">
                @foreach ([
                    ['name' => 'Morgan P.', 'quote' => 'Best decision I made this year. The trainers actually care about your progress.'],
                    ['name' => 'Casey R.', 'quote' => 'Clean equipment, flexible hours, and a community that keeps me showing up.'],
                    ['name' => 'Riley T.', 'quote' => 'Lost 15kg in six months following the plan my coach built for me.'],
                ] as $i => $t)
                    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
                        <div class="flex gap-0.5 text-amber-400">
                            @for ($s = 0; $s < 5; $s++)
                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.958a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.368 2.447a1 1 0 00-.364 1.118l1.287 3.957c.3.922-.755 1.688-1.538 1.118l-3.367-2.446a1 1 0 00-1.176 0l-3.367 2.446c-.783.57-1.838-.196-1.538-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.062 9.385c-.783-.57-.38-1.81.588-1.81h4.163a1 1 0 00.95-.69l1.286-3.958z" /></svg>
                            @endfor
                        </div>
                        <p class="mt-4 text-sm text-gray-600 leading-relaxed">&ldquo;{{ $t['quote'] }}&rdquo;</p>
                        <div class="mt-5 flex items-center gap-3">
                            <div class="h-9 w-9 rounded-full bg-gradient-to-br {{ $avatarColors[$i % count($avatarColors)] }} text-white flex items-center justify-center text-xs font-bold">
                                {{ substr($t['name'], 0, 1) }}
                            </div>
                            <div class="text-sm font-semibold">{{ $t['name'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    @if ($home['cta_heading'] || $home['cta_text'])
        <section class="relative overflow-hidden bg-gray-900 text-white">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/40 via-gray-900 to-gray-900"></div>
            <div class="relative max-w-6xl mx-auto px-6 py-20 text-center">
                @if ($home['cta_heading'])
                    <h2 class="text-3xl font-extrabold">{{ $home['cta_heading'] }}</h2>
                @endif
                @if ($home['cta_text'])
                    <p class="mt-3 text-gray-300 max-w-xl mx-auto">{{ $home['cta_text'] }}</p>
                @endif
                @if ($home['cta_button_label'] && $home['cta_button_url'])
                    <a href="{{ $home['cta_button_url'] }}"
                        class="inline-block mt-8 px-8 py-3.5 bg-indigo-600 text-white text-sm font-semibold rounded-lg shadow-lg shadow-indigo-900/40 hover:bg-indigo-500 transition">
                        {{ $home['cta_button_label'] }}
                    </a>
                @endif
            </div>
        </section>
    @endif
</x-site-layout>
