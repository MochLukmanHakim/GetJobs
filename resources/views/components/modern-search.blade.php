{{-- Modern Search Component --}}
<div class="modern-search-container">
    <div class="search-wrapper">
        <div class="search-input-wrapper">
            <input 
                type="text" 
                class="search-main-input" 
                placeholder="Masukkan kata kunci..." 
                id="{{ $searchId ?? 'search-input' }}"
                value="{{ request($searchParam ?? 'search') }}"
            >
        </div>
        
        
        <div class="search-dropdown-wrapper">
            <div class="dropdown-item">
                <button type="button" class="search-dropdown-toggle" id="categories-dropdown">
                    <svg class="dropdown-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <span class="dropdown-text">Categories</span>
                    <svg class="dropdown-arrow" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6,9 12,15 18,9"></polyline>
                    </svg>
                </button>
                <div class="dropdown-menu" id="categories-menu">
                    @if(isset($pageType) && $pageType === 'pelamar')
                        <div class="dropdown-option" data-value="">Semua Pekerjaan</div>
                    @else
                        <div class="dropdown-option" data-value="">Semua Kategori</div>
                    @endif
                    
                    @php
                        // Get categories from database if available
                        $dbCategories = isset($categories) && is_array($categories) ? $categories : [];
                        
                        // For pelamar page, categories are job titles, so use them directly
                        $finalCategories = [];
                        
                        // Add job titles as categories for pelamar page
                        foreach($dbCategories as $category) {
                            if (!empty($category)) {
                                $finalCategories[] = $category;
                            }
                        }
                        
                        // Remove duplicates and sort
                        $finalCategories = array_unique($finalCategories);
                        sort($finalCategories);
                    @endphp
                    
                    @foreach($finalCategories as $categoryKey => $displayCategory)
                        <div class="dropdown-option" data-value="{{ $displayCategory }}">{{ $displayCategory }}</div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <button type="button" class="search-button" onclick="performSearch()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"></circle>
                <path d="m21 21-4.35-4.35"></path>
            </svg>
            <span>Search</span>
        </button>
    </div>
</div>

<style>
.modern-search-container {
    width: 100%;
    max-width: 480px;
    margin: 0 0 24px 0;
}

.search-wrapper {
    display: flex;
    align-items: center;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: 3px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    transition: all 0.2s ease;
}

.search-wrapper:focus-within {
    border-color: #002746;
    box-shadow: 0 0 0 3px rgba(0, 39, 70, 0.1);
}

.search-input-wrapper {
    flex: 1;
    min-width: 0;
}

.search-main-input {
    width: 100%;
    border: none;
    outline: none;
    padding: 10px 14px;
    font-size: 13px;
    background: transparent;
    color: #374151;
}

.search-main-input::placeholder {
    color: #9ca3af;
}

.search-dropdown-wrapper {
    position: relative;
    flex-shrink: 0;
}

.dropdown-item {
    position: relative;
}

.search-dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 10px;
    border: none;
    background: transparent;
    color: #6b7280;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    border-radius: 6px;
    transition: all 0.2s ease;
    white-space: nowrap;
}

.search-dropdown-toggle:hover {
    background: #f3f4f6;
    color: #374151;
}

.search-dropdown-toggle.active {
    background: #f0f4f8;
    color: #002746;
}

.dropdown-icon {
    flex-shrink: 0;
    color: currentColor;
}

.dropdown-arrow {
    flex-shrink: 0;
    transition: transform 0.2s ease;
}

.search-dropdown-toggle.active .dropdown-arrow {
    transform: rotate(180deg);
}

.dropdown-text {
    font-weight: 500;
}


.dropdown-menu {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    z-index: 50;
    display: none;
    margin-top: 4px;
    min-width: 280px;
    max-width: 350px;
    width: max-content;
}

.dropdown-menu.show {
    display: block;
}

.dropdown-option {
    padding: 12px 16px;
    font-size: 14px;
    color: #374151;
    cursor: pointer;
    transition: background 0.2s ease;
    border-bottom: 1px solid #f3f4f6;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    line-height: 1.4;
}

.dropdown-option:last-child {
    border-bottom: none;
}

.dropdown-option:hover {
    background: #f3f4f6;
}

.dropdown-option.selected {
    background: #f0f4f8;
    color: #002746;
    font-weight: 500;
}

.search-button {
    background: #002746;
    color: white;
    border: none;
    padding: 10px 16px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
    white-space: nowrap;
    flex-shrink: 0;
}

.search-button:hover {
    background: #003d5c;
}

.search-button:active {
    transform: translateY(0);
}

/* Responsive Design */
@media (max-width: 768px) {
    .search-wrapper {
        flex-direction: column;
        gap: 8px;
        padding: 12px;
    }
    
    .search-input-wrapper {
        width: 100%;
    }
    
    .search-dropdown-wrapper {
        width: 100%;
    }
    
    .dropdown-toggle {
        width: 100%;
        justify-content: space-between;
        padding: 12px;
        background: #f9fafb;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
    }
    
    .dropdown-menu {
        left: 0;
        right: 0;
        min-width: auto;
        max-width: 100%;
        width: 100%;
    }
    
    .search-button {
        width: 100%;
        justify-content: center;
        padding: 12px;
    }
}

@media (max-width: 480px) {
    .modern-search-container {
        padding: 0 16px;
    }
    
    .dropdown-text {
        display: none;
    }
    
    .search-button span {
        display: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize page to show all categories/jobs
    initializeApplicantView();
    initializeJobView();
    
    // Initialize dropdowns
    const dropdowns = document.querySelectorAll('.search-dropdown-toggle');
    const searchData = {
        category: '',
        search: ''
    };
    
    dropdowns.forEach(dropdown => {
        dropdown.addEventListener('click', function(e) {
            e.stopPropagation();
            
            // Close other dropdowns
            dropdowns.forEach(other => {
                if (other !== dropdown) {
                    other.classList.remove('active');
                    other.nextElementSibling.classList.remove('show');
                }
            });
            
            // Toggle current dropdown
            dropdown.classList.toggle('active');
            const menu = dropdown.nextElementSibling;
            menu.classList.toggle('show');
        });
    });
    
    // Handle dropdown option selection
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('dropdown-option')) {
            const option = e.target;
            const menu = option.closest('.dropdown-menu');
            const toggle = menu.previousElementSibling;
            const value = option.getAttribute('data-value');
            const text = option.textContent;
            
            // Update selected option
            menu.querySelectorAll('.dropdown-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            option.classList.add('selected');
            
            // Update toggle text
            const textSpan = toggle.querySelector('.dropdown-text');
            if (value === '') {
                textSpan.textContent = 'Categories';
            } else {
                textSpan.textContent = text;
            }
            
            // Store selection
            if (toggle.id === 'categories-dropdown') {
                searchData.category = value;
            }
            
            // Close dropdown
            toggle.classList.remove('active');
            menu.classList.remove('show');
        }
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown-item')) {
            dropdowns.forEach(dropdown => {
                dropdown.classList.remove('active');
                dropdown.nextElementSibling.classList.remove('show');
            });
        }
    });
    
    // Handle search input
    const searchInput = document.querySelector('.search-main-input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            searchData.search = this.value;
        });
        
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
    }
});

function performSearch() {
    const searchInput = document.querySelector('.search-main-input');
    const searchTerm = searchInput ? searchInput.value.trim() : '';
    
    console.log('performSearch called with term:', searchTerm);
    
    // Get current page type
    const isApplicantPage = document.querySelector('.applicant-cards') !== null;
    const isJobPage = document.querySelector('.job-cards') !== null;
    
    console.log('Page type:', { isApplicantPage, isJobPage });
    
    if (isApplicantPage) {
        performApplicantSearch(searchTerm);
    } else if (isJobPage) {
        performJobSearch(searchTerm);
    }
}

function performApplicantSearch(searchTerm) {
    const applicantContainers = document.querySelectorAll('.applicant-cards');
    const categoryFilter = document.querySelector('#categories-dropdown .dropdown-text').textContent;
    
    // First, hide all containers
    applicantContainers.forEach(container => {
        container.style.display = 'none';
    });
    
    // If category filter is selected, show only matching containers
    if (categoryFilter && categoryFilter !== 'Categories') {
        applicantContainers.forEach(container => {
            const containerCategory = container.id;
            if (containerCategory === categoryFilter) {
                container.style.display = 'block';
                
                // Apply search term filter within this container
                const applicantCards = container.querySelectorAll('.applicant-card');
                applicantCards.forEach(card => {
                    const name = card.querySelector('.applicant-details h4')?.textContent.toLowerCase() || '';
                    const email = card.querySelector('.applicant-email')?.textContent.toLowerCase() || '';
                    
                    let showCard = true;
                    
                    // Search term filter
                    if (searchTerm && !name.includes(searchTerm.toLowerCase()) && !email.includes(searchTerm.toLowerCase())) {
                        showCard = false;
                    }
                    
                    card.style.display = showCard ? 'block' : 'none';
                });
            }
        });
    } else {
        // No category filter, show all containers and apply search term filter
        applicantContainers.forEach(container => {
            container.style.display = 'block';
            
            const applicantCards = container.querySelectorAll('.applicant-card');
            applicantCards.forEach(card => {
                const name = card.querySelector('.applicant-details h4')?.textContent.toLowerCase() || '';
                const email = card.querySelector('.applicant-email')?.textContent.toLowerCase() || '';
                
                let showCard = true;
                
                // Search term filter
                if (searchTerm && !name.includes(searchTerm.toLowerCase()) && !email.includes(searchTerm.toLowerCase())) {
                    showCard = false;
                }
                
                card.style.display = showCard ? 'block' : 'none';
            });
        });
    }
}

function performJobSearch(searchTerm) {
    const jobCards = document.querySelectorAll('.job-card');
    const categoryFilter = document.querySelector('#categories-dropdown .dropdown-text').textContent;
    
    console.log('performJobSearch called with:', { searchTerm, categoryFilter });
    console.log('Found job cards:', jobCards.length);
    
    // If no specific search term and no specific category, show all jobs
    if ((!searchTerm || searchTerm.trim() === '') && 
        (!categoryFilter || categoryFilter === 'Categories' || categoryFilter === 'Semua Kategori')) {
        jobCards.forEach(card => {
            card.style.display = 'block';
        });
        console.log('Showing all jobs - no filters applied');
        return;
    }
    
    jobCards.forEach(card => {
        const title = card.querySelector('.job-details h4')?.textContent || '';
        const category = card.querySelector('.job-position')?.textContent || '';
        
        console.log('Processing card:', { title, category });
        
        let showCard = true;
        
        // Search term filter
        if (searchTerm && searchTerm.trim() !== '') {
            const searchLower = searchTerm.toLowerCase();
            const titleLower = title.toLowerCase();
            const categoryLower = category.toLowerCase();
            
            if (!titleLower.includes(searchLower) && !categoryLower.includes(searchLower)) {
                showCard = false;
                console.log('Hidden by search term filter');
            }
        }
        
        // Category filter - improved matching logic
        if (categoryFilter && categoryFilter !== 'Categories' && categoryFilter !== 'Semua Kategori') {
            const filterLower = categoryFilter.toLowerCase().trim();
            const categoryLower = category.toLowerCase().trim();
            
            // Create reverse mapping for better matching
            const categoryMappings = {
                'technology': ['technology', 'tech', 'it', 'software', 'programming'],
                'design': ['design', 'designer', 'ui', 'ux', 'graphic'],
                'marketing': ['marketing', 'digital marketing', 'social media', 'advertising'],
                'finance': ['finance', 'accounting', 'financial', 'budget'],
                'human resources': ['hr', 'human resources', 'recruitment', 'people'],
                'sales': ['sales', 'selling', 'business development', 'account'],
                'operations': ['operations', 'operational', 'logistics', 'supply'],
                'customer service': ['customer service', 'support', 'help desk', 'client'],
                'administration': ['admin', 'administration', 'administrative', 'office']
            };
            
            let categoryMatches = false;
            
            // Check direct match
            if (categoryLower === filterLower || categoryLower.includes(filterLower) || filterLower.includes(categoryLower)) {
                categoryMatches = true;
            } else {
                // Check mapping matches
                for (const [key, aliases] of Object.entries(categoryMappings)) {
                    if (filterLower === key || aliases.includes(filterLower)) {
                        if (aliases.some(alias => categoryLower.includes(alias)) || categoryLower.includes(key)) {
                            categoryMatches = true;
                            break;
                        }
                    }
                }
            }
            
            if (!categoryMatches) {
                showCard = false;
                console.log('Hidden by category filter:', { categoryFilter: filterLower, category: categoryLower });
            }
        }
        
        console.log('Card visibility:', showCard);
        card.style.display = showCard ? 'block' : 'none';
    });
}

function initializeApplicantView() {
    // Show all applicant containers on page load
    const applicantContainers = document.querySelectorAll('.applicant-cards');
    applicantContainers.forEach(container => {
        container.style.display = 'block';
        
        // Show all applicant cards within each container
        const applicantCards = container.querySelectorAll('.applicant-card');
        applicantCards.forEach(card => {
            card.style.display = 'block';
        });
    });
}

function initializeJobView() {
    // Show all job cards on page load
    const jobCards = document.querySelectorAll('.job-card');
    console.log('initializeJobView - Found job cards:', jobCards.length);
    
    jobCards.forEach(card => {
        card.style.display = 'block';
        console.log('Showing job card:', card.querySelector('.job-details h4')?.textContent);
    });
    
    // Reset dropdown to default state
    const categoryDropdown = document.querySelector('#categories-dropdown .dropdown-text');
    if (categoryDropdown) {
        categoryDropdown.textContent = 'Categories';
    }
}
</script>
