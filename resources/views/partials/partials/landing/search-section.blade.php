<!-- Advanced Search Section - Copied from seeker/browse-jobs -->
<div class="mb-6 p-4">
    <div class="bg-gradient-to-br from-blue-50 via-cyan-50 to-teal-50 rounded-2xl shadow-lg border border-blue-100 overflow-hidden">
        <div x-data="{ showAdvanced: false }">
            <div class="bg-white/60 backdrop-blur-sm p-4">
                <div class="bg-white/80 rounded-xl p-4 border border-blue-100">
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-3">
                        <div class="md:col-span-4 relative">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-blue-400"></i>
                            <input type="text" id="searchInput" placeholder="Job title, keywords..." class="w-full pl-10 pr-4 py-3 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white">
                        </div>
                        <div class="md:col-span-3 relative">
                            <i class="fas fa-map-marker-alt absolute left-3 top-1/2 transform -translate-y-1/2 text-cyan-400"></i>
                            <input type="text" id="locationInput" placeholder="Location..." class="w-full pl-10 pr-4 py-3 border border-cyan-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all bg-white">
                        </div>
                        <div class="md:col-span-2 relative">
                            <i class="fas fa-briefcase absolute left-3 top-1/2 transform -translate-y-1/2 text-teal-400"></i>
                            <select id="categoryInput" class="w-full pl-10 pr-4 py-3 border border-teal-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all appearance-none bg-white">
                                <option value="">All Categories</option>
                                <option value="technology">Technology</option>
                                <option value="finance">Finance</option>
                                <option value="healthcare">Healthcare</option>
                                <option value="education">Education</option>
                                <option value="marketing">Marketing</option>
                                <option value="construction">Construction</option>
                            </select>
                        </div>
                        <div class="md:col-span-3 flex gap-2">
                            <button onclick="filterJobs()" class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white rounded-lg hover:shadow-lg transition-all duration-300 font-semibold">
                                <i class="fas fa-search mr-2"></i>Search
                            </button>
                            <button onclick="resetFilters()" class="px-4 py-3 bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700 rounded-lg hover:shadow-md transition-all duration-300 font-semibold">
                                <i class="fas fa-redo"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Advanced Filters Section -->
                    <div x-show="showAdvanced" x-collapse class="mt-4 pt-4 border-t border-blue-100">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                            <select id="jobTypeInput" class="w-full px-4 py-3 border border-blue-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                                <option value="">All Job Types</option>
                                <option value="full-time">Full-time</option>
                                <option value="part-time">Part-time</option>
                                <option value="contract">Contract</option>
                                <option value="internship">Internship</option>
                            </select>
                            <select id="levelInput" class="w-full px-4 py-3 border border-cyan-200 rounded-lg focus:ring-2 focus:ring-cyan-500 focus:border-transparent bg-white">
                                <option value="">All Levels</option>
                                <option value="entry">Entry Level</option>
                                <option value="mid">Mid Level</option>
                                <option value="senior">Senior</option>
                                <option value="executive">Executive</option>
                            </select>
                            <select id="workArrangementInput" class="w-full px-4 py-3 border border-teal-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent bg-white">
                                <option value="">All Arrangements</option>
                                <option value="remote">Remote</option>
                                <option value="on-site">On-site</option>
                                <option value="hybrid">Hybrid</option>
                            </select>
                            <select id="sortInput" class="w-full px-4 py-3 border border-purple-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-white">
                                <option value="newest">Most Recent</option>
                                <option value="relevant">Most Relevant</option>
                                <option value="salary_high">Salary: High to Low</option>
                                <option value="salary_low">Salary: Low to High</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-3 flex justify-end">
                    <button type="button" @click="showAdvanced = !showAdvanced" class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition flex items-center gap-2">
                        <i class="fas fa-sliders-h"></i>
                        <span x-text="showAdvanced ? 'Hide Advanced' : 'Show Advanced'"></span>
                        <i class="fas fa-chevron-down text-xs transition-transform" :class="showAdvanced ? 'rotate-180' : ''"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>