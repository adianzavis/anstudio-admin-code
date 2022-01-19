@if(session()->has('danger'))
    <div id="notification-message" class="hidden message">
        <div class="alert alert-danger show flex items-center justify-between mb-1 p-10" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle block mx-auto block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
            <span class="pl-1 pr-10 text-white">{{ session()->get('danger') }}</span>
        </div>
    </div>
@endif

@if(session()->has('warning'))
    <div id="notification-message" class="hidden message">
        <div class="alert alert-warning show flex items-center justify-between mb-1 p-10" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle text-white w-6 h-6 mr-2 w-6 h-6 mr-2">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                <line x1="12" y1="9" x2="12" y2="13"></line>
                <line x1="12" y1="17" x2="12.01" y2="17"></line>
            </svg>
            <span class="pl-1 pr-10 text-white">{{ session()->get('warning') }}</span>
        </div>
    </div>
@endif

@if(session()->has('success'))
    <div id="notification-message" class="hidden message">
        <div class="alert alert-success show flex items-center justify-between mb-1 p-10" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check block mx-auto block mx-auto"><polyline points="20 6 9 17 4 12"></polyline></svg>
            <span class="pl-1 pr-10 text-white">{{ session()->get('success') }}</span>
        </div>
    </div>
@endif
