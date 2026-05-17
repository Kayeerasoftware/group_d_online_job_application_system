<!-- Job Detail Modal -->
<div id="jobDetailModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4" style="display: none;">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg flex flex-col max-h-[90vh]">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-4 flex justify-between items-start flex-shrink-0">
            <div class="flex-1">
                <h2 id="modalJobTitle" class="text-xl font-bold text-white mb-1"></h2>
                <p id="modalJobLocation" class="text-blue-100 flex items-center gap-2 text-sm">
                    <i class="fas fa-map-marker-alt"></i><span></span>
                </p>
            </div>
            <button onclick="closeJobModal()" class="text-white hover:bg-blue-700 p-2 rounded-lg transition flex-shrink-0">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Modal Body - Scrollable -->
        <div class="p-4 space-y-4 overflow-y-auto flex-1">
            <!-- Company Info -->
            <div class="flex items-center gap-3 pb-3 border-b border-gray-200">
                <div id="modalCompanyLogo" class="w-12 h-12 rounded-lg bg-gray-200 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-building text-gray-400 text-lg"></i>
                </div>
                <div>
                    <p class="text-xs text-gray-600 uppercase font-semibold">Company</p>
                    <p id="modalCompanyName" class="text-sm font-bold text-gray-900"></p>
                </div>
            </div>

            <!-- Key Info Cards -->
            <div class="grid grid-cols-3 gap-2">
                <div class="bg-blue-50 rounded-lg p-2 border border-blue-200">
                    <p class="text-xs text-gray-600 font-semibold uppercase">Job Type</p>
                    <p id="modalJobType" class="text-xs font-bold text-blue-700 mt-1"></p>
                </div>
                <div class="bg-green-50 rounded-lg p-2 border border-green-200">
                    <p class="text-xs text-gray-600 font-semibold uppercase">Salary</p>
                    <p id="modalSalary" class="text-xs font-bold text-green-700 mt-1"></p>
                </div>
                <div class="bg-purple-50 rounded-lg p-2 border border-purple-200">
                    <p class="text-xs text-gray-600 font-semibold uppercase">Status</p>
                    <p id="modalStatus" class="text-xs font-bold text-purple-700 mt-1"></p>
                </div>
            </div>

            <!-- Description -->
            <div>
                <h3 class="text-sm font-bold text-gray-900 mb-2 flex items-center">
                    <i class="fas fa-file-alt text-blue-600 mr-2"></i>Description
                </h3>
                <p id="modalDescription" class="text-gray-700 leading-relaxed text-xs"></p>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="bg-gray-50 border-t border-gray-200 p-4 flex gap-2 flex-shrink-0">
            <button onclick="closeJobModal()" class="flex-1 px-3 py-2 bg-gray-300 text-gray-800 rounded-lg font-semibold hover:bg-gray-400 transition text-sm">
                Close
            </button>
            <button id="modalApplyBtn" onclick="applyJob()" class="flex-1 px-3 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition text-sm">
                <i class="fas fa-paper-plane mr-1"></i>Apply
            </button>
        </div>
    </div>
</div>

<script>
let currentJobId = null;

function applyJob() {
    if (currentJobId) {
        const jobCard = document.querySelector(`[data-job-id="${currentJobId}"]`);
        if (jobCard) {
            const applyUrl = jobCard.dataset.applyUrl;
            if (applyUrl && applyUrl !== '#') {
                window.location.href = applyUrl;
                return;
            }
        }
    }
}

function openJobModal(jobId) {
    currentJobId = jobId;
    const jobCard = document.querySelector(`[data-job-id="${jobId}"]`);
    if (!jobCard) {
        console.error('Job card not found for ID:', jobId);
        return;
    }

    try {
        // Extract title from h3
        const title = jobCard.querySelector('h3')?.textContent?.trim() || 'N/A';
        
        // Extract company name - it's in a div with "Company" label
        const companyDiv = Array.from(jobCard.querySelectorAll('div')).find(div => {
            const p = div.querySelector('p.text-xs');
            return p && p.textContent.includes('Company');
        });
        const companyName = companyDiv?.querySelector('p.text-sm.text-gray-700')?.textContent?.trim() || 'Unknown';
        
        // Extract description - it has line-clamp-3 class
        const description = jobCard.querySelector('p.line-clamp-3')?.textContent?.trim() || 'No description';
        
        // Extract location - first p with map icon in details section
        let location = 'Not specified';
        const detailsDiv = jobCard.querySelector('div.space-y-2');
        if (detailsDiv) {
            const locationP = Array.from(detailsDiv.querySelectorAll('p')).find(p => 
                p.innerHTML.includes('fa-map-marker-alt')
            );
            if (locationP) {
                location = locationP.textContent.replace(/[^\w\s,]/g, '').trim();
            }
        }
        
        // Extract job type - p with briefcase icon
        let jobType = 'N/A';
        if (detailsDiv) {
            const typeP = Array.from(detailsDiv.querySelectorAll('p')).find(p => 
                p.innerHTML.includes('fa-briefcase')
            );
            if (typeP) {
                jobType = typeP.textContent.replace(/[^\w\s]/g, '').trim();
            }
        }
        
        // Extract salary - p with dollar sign or UGX
        let salary = 'Not specified';
        if (detailsDiv) {
            const salaryP = Array.from(detailsDiv.querySelectorAll('p')).find(p => 
                p.innerHTML.includes('fa-dollar-sign') || p.textContent.includes('UGX')
            );
            if (salaryP) {
                salary = salaryP.textContent.trim();
            }
        }
        
        // Extract status from badge
        const statusBadge = jobCard.querySelector('span[class*="bg-green-100"], span[class*="bg-red-100"], span[class*="bg-orange-100"]');
        const status = statusBadge?.textContent?.trim() || 'Open';
        
        // Get company logo
        const logoImg = jobCard.querySelector('img[alt="Company"]');
        const logoContainer = document.getElementById('modalCompanyLogo');
        if (logoImg && logoImg.src && logoImg.style.display !== 'none') {
            logoContainer.innerHTML = `<img src="${logoImg.src}" alt="Company" class="w-full h-full object-cover rounded-lg">`;
        } else {
            logoContainer.innerHTML = `<i class="fas fa-building text-gray-400 text-lg"></i>`;
        }

        // Populate modal
        document.getElementById('modalJobTitle').textContent = title;
        document.getElementById('modalJobLocation').querySelector('span').textContent = location;
        document.getElementById('modalCompanyName').textContent = companyName;
        document.getElementById('modalJobType').textContent = jobType;
        document.getElementById('modalSalary').textContent = salary;
        document.getElementById('modalDescription').textContent = description;
        document.getElementById('modalStatus').textContent = status;

        // Show modal
        const modal = document.getElementById('jobDetailModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        
    } catch (error) {
        console.error('Error opening modal:', error);
    }
}

function closeJobModal() {
    const modal = document.getElementById('jobDetailModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('jobDetailModal');
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeJobModal();
            }
        });
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeJobModal();
    }
});
</script>
