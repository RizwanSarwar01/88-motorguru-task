<x-app-layout>
    <x-breadcrumb :breadcrumbs="[
        ['url' => '/', 'label' => 'Dashboard'],
        ['url' => '/employees', 'label' => 'Employees'],
        ['url' => '#', 'label' => $title]
    ]" />

    <x-dynamic-heading title="{{$title}}" />

    <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" id="employeeForm">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <!-- Main Form Section (col-8) -->
            <div class="lg:col-span-8">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <!-- Image Upload Section -->
                        <div class="mb-6 flex justify-center">
                            <div class="relative">
                                <div id="imagePreview" class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden border-4 border-gray-300">
                                    <span class="text-gray-500 text-sm">IMAGE</span>
                                </div>
                                <input type="file" id="imageInput" name="image" accept="image/*" class="hidden" onchange="handleImageSelect(event)">
                                <input type="hidden" id="imageBase64" name="image_base64">
                                <div class="mt-4 flex gap-2 justify-center">
                                    <button type="button" onclick="document.getElementById('imageInput').click()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 text-sm">
                                        Upload
                                    </button>
                                    <button type="button" onclick="openCamera()" class="px-4 py-2 bg-[#52A758] text-white rounded-lg hover:bg-[#458F4A] text-sm">
                                        Camera
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- First Name Field -->
                            <div>
                                <label for="first_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    First Name <span class="text-red-500">*</span>
                                </label>
                                <input
                                    value="{{ old('first_name') }}"
                                    id="first_name"
                                    name="first_name"
                                    type="text"
                                    placeholder="Enter first name"
                                    class="block w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] transition-colors"
                                >
                                @error('first_name')
                                    <div class="text-red-600 text-sm mt-1.5 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Last Name Field -->
                            <div>
                                <label for="last_name" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Last Name
                                </label>
                                <input
                                    value="{{ old('last_name') }}"
                                    id="last_name"
                                    name="last_name"
                                    type="text"
                                    placeholder="Enter last name"
                                    class="block w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] transition-colors"
                                >
                                @error('last_name')
                                    <div class="text-red-600 text-sm mt-1.5 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div>
                                <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Email
                                </label>
                                <input
                                    value="{{ old('email') }}"
                                    id="email"
                                    name="email"
                                    type="email"
                                    placeholder="Enter email address"
                                    class="block w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] transition-colors"
                                >
                                @error('email')
                                    <div class="text-red-600 text-sm mt-1.5 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Mobile No. Field -->
                            <div>
                                <label for="mobile_number" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Mobile No. <span class="text-red-500">*</span>
                                </label>
                                <div class="flex">
                                    <select name="mobile_country_code" id="mobile_country_code" class="px-3 py-2.5 text-sm border border-r-0 border-gray-300 rounded-l-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] bg-white appearance-none pr-8 bg-no-repeat bg-right" style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-position: right 0.5rem center; background-size: 1.25em 1.25em;">
                                        <option value="+971" {{ old('mobile_country_code', '+971') == '+971' ? 'selected' : '' }}>+971</option>
                                        <option value="+1" {{ old('mobile_country_code') == '+1' ? 'selected' : '' }}>+1</option>
                                        <option value="+44" {{ old('mobile_country_code') == '+44' ? 'selected' : '' }}>+44</option>
                                        <option value="+91" {{ old('mobile_country_code') == '+91' ? 'selected' : '' }}>+91</option>
                                    </select>
                                    <input
                                        value="{{ old('mobile_number') }}"
                                        id="mobile_number"
                                        name="mobile_number"
                                        type="text"
                                        placeholder="050 123 4567"
                                        class="block w-full px-4 py-2.5 text-sm border border-gray-300 rounded-r-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] transition-colors"
                                    >
                                </div>
                                @error('mobile_number')
                                    <div class="text-red-600 text-sm mt-1.5 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Alternate Mobile No. Field -->
                            <div>
                                <label for="alternate_mobile_number" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Alternate Mobile No.
                                </label>
                                <div class="flex">
                                    <select name="alternate_mobile_country_code" id="alternate_mobile_country_code" class="px-3 py-2.5 text-sm border border-r-0 border-gray-300 rounded-l-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] bg-white appearance-none pr-8 bg-no-repeat bg-right" style="background-image: url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 24 24%27 fill=%27none%27 stroke=%27currentColor%27 stroke-width=%272%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27%3e%3cpolyline points=%276 9 12 15 18 9%27%3e%3c/polyline%3e%3c/svg%3e'); background-position: right 0.5rem center; background-size: 1.25em 1.25em;">
                                        <option value="+971" {{ old('alternate_mobile_country_code', '+971') == '+971' ? 'selected' : '' }}>+971</option>
                                        <option value="+1" {{ old('alternate_mobile_country_code') == '+1' ? 'selected' : '' }}>+1</option>
                                        <option value="+44" {{ old('alternate_mobile_country_code') == '+44' ? 'selected' : '' }}>+44</option>
                                        <option value="+91" {{ old('alternate_mobile_country_code') == '+91' ? 'selected' : '' }}>+91</option>
                                    </select>
                                    <input
                                        value="{{ old('alternate_mobile_number') }}"
                                        id="alternate_mobile_number"
                                        name="alternate_mobile_number"
                                        type="text"
                                        placeholder="050 123 4567"
                                        class="block w-full px-4 py-2.5 text-sm border border-gray-300 rounded-r-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] transition-colors"
                                    >
                                </div>
                                @error('alternate_mobile_number')
                                    <div class="text-red-600 text-sm mt-1.5 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Nationality Field -->
                            <div>
                                <label for="nationality_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Nationality
                                </label>
                                <select name="nationality_id" id="nationality_id" class="block w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] bg-white">
                                    <option value="">Select</option>
                                    @foreach($nationalities as $nationality)
                                        <option value="{{ $nationality->id }}" {{ old('nationality_id') == $nationality->id ? 'selected' : '' }}>{{ $nationality->name }}</option>
                                    @endforeach
                                </select>
                                @error('nationality_id')
                                    <div class="text-red-600 text-sm mt-1.5 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Department Field -->
                            <div>
                                <label for="department_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Department
                                </label>
                                <select name="department_id" id="department_id" class="block w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] bg-white">
                                    <option value="">Select</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <div class="text-red-600 text-sm mt-1.5 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Designation Field -->
                            <div>
                                <label for="designation_id" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Designation
                                </label>
                                <select name="designation_id" id="designation_id" class="block w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] bg-white">
                                    <option value="">Select</option>
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}" {{ old('designation_id') == $designation->id ? 'selected' : '' }}>{{ $designation->name }}</option>
                                    @endforeach
                                </select>
                                @error('designation_id')
                                    <div class="text-red-600 text-sm mt-1.5 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Date of Birth Field -->
                            <div class="mb-4">
                                <label for="date_of_birth" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Date of Birth
                                </label>
                                <input
                                    value="{{ old('date_of_birth') }}"
                                    id="date_of_birth"
                                    name="date_of_birth"
                                    type="date"
                                    class="block w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] transition-colors"
                                >
                                @error('date_of_birth')
                                    <div class="text-red-600 text-sm mt-1.5 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Date of Joining Field -->
                            <div class="mb-4">
                                <label for="date_of_joining" class="block text-sm font-semibold text-gray-700 mb-2">
                                    Date of Joining
                                </label>
                                <input
                                    value="{{ old('date_of_joining') }}"
                                    id="date_of_joining"
                                    name="date_of_joining"
                                    type="date"
                                    class="block w-full px-4 py-2.5 text-sm border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#52A758] focus:border-[#52A758] transition-colors"
                                >
                                @error('date_of_joining')
                                    <div class="text-red-600 text-sm mt-1.5 flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                            <a href="{{ route('employees.index') }}" class="text-sm text-gray-600 hover:text-gray-900 transition-colors">
                                ← Back to Employees
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-[#52A758] border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-[#458F4A] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#52A758] transition-all duration-200 shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Section (col-4) -->
            <div class="lg:col-span-4">
                <!-- Help Card -->
                <div class="bg-gradient-to-br from-[#52A758] to-[#458F4A] shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-white ml-2">Need Help?</h3>
                        </div>
                        <p class="text-sm text-white/90 mb-4">
                            Make sure to fill in all required fields marked with <span class="text-red-200">*</span>
                        </p>
                        <ul class="space-y-2 text-sm text-white/90">
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>First Name and Mobile Number are required</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>You can upload image via file or camera</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span>All other fields are optional</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Camera Modal -->
    <div id="cameraModal" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Take Photo</h3>
                <button onclick="closeCamera()" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <video id="video" autoplay class="w-full rounded-lg mb-4" style="display: none;"></video>
            <canvas id="canvas" class="w-full rounded-lg mb-4" style="display: none;"></canvas>
            <div id="cameraPreview" class="w-full rounded-lg mb-4 bg-gray-200 flex items-center justify-center" style="height: 300px;">
                <span class="text-gray-500">Camera preview will appear here</span>
            </div>
            <div class="flex gap-2 justify-center">
                <button onclick="startCamera()" id="startBtn" class="px-4 py-2 bg-[#52A758] text-white rounded-lg hover:bg-[#458F4A]">
                    Start Camera
                </button>
                <button onclick="capturePhoto()" id="captureBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700" style="display: none;">
                    Capture
                </button>
                <button onclick="usePhoto()" id="useBtn" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700" style="display: none;">
                    Use Photo
                </button>
            </div>
        </div>
    </div>

    <script>
        let stream = null;
        let capturedImage = null;

        function handleImageSelect(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    displayImage(e.target.result);
                    document.getElementById('imageBase64').value = '';
                };
                reader.readAsDataURL(file);
            }
        }

        function displayImage(imageSrc) {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = `<img src="${imageSrc}" alt="Preview" class="w-full h-full object-cover rounded-full">`;
        }

        function openCamera() {
            document.getElementById('cameraModal').classList.remove('hidden');
        }

        function closeCamera() {
            document.getElementById('cameraModal').classList.add('hidden');
            stopCamera();
        }

        function startCamera() {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function(mediaStream) {
                    stream = mediaStream;
                    const video = document.getElementById('video');
                    video.srcObject = stream;
                    video.style.display = 'block';
                    document.getElementById('cameraPreview').style.display = 'none';
                    document.getElementById('startBtn').style.display = 'none';
                    document.getElementById('captureBtn').style.display = 'inline-block';
                })
                .catch(function(err) {
                    alert('Error accessing camera: ' + err.message);
                });
        }

        function capturePhoto() {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const context = canvas.getContext('2d');

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0);

            capturedImage = canvas.toDataURL('image/png');
            canvas.style.display = 'block';
            video.style.display = 'none';
            document.getElementById('captureBtn').style.display = 'none';
            document.getElementById('useBtn').style.display = 'inline-block';
        }

        function usePhoto() {
            if (capturedImage) {
                displayImage(capturedImage);
                document.getElementById('imageBase64').value = capturedImage;
                document.getElementById('imageInput').value = '';
                closeCamera();
            }
        }

        function stopCamera() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
                stream = null;
            }
            document.getElementById('video').style.display = 'none';
            document.getElementById('canvas').style.display = 'none';
            document.getElementById('cameraPreview').style.display = 'flex';
            document.getElementById('startBtn').style.display = 'inline-block';
            document.getElementById('captureBtn').style.display = 'none';
            document.getElementById('useBtn').style.display = 'none';
            capturedImage = null;
        }
    </script>
</x-app-layout>
