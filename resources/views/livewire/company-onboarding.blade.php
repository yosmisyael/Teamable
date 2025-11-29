<div class="min-h-screen w-full flex flex-col items-center justify-center p-4 lg:p-8">

    <!-- Onboarding Card -->
    <div class="bg-white p-8 sm:p-12 rounded-2xl shadow-2xl w-full max-w-lg">
        <h2 class="text-3xl font-bold text-primary text-center">Company Onboarding</h2>
        <p class="text-gray-500 text-center text-base mt-2 mb-8">Complete your company profile setup</p>

        <!-- Progress Stepper -->
        <div class="mb-8">
            <!-- Step Labels -->
            <div class="flex justify-between text-sm text-gray-500 mb-2">
                <span>Step {{ $currentStep }} of 2</span>
                <span class="font-medium text-primary">{{ $currentStep / 2 * 100 }}% Complete</span>
            </div>
            <!-- Progress Bar -->
            <div class="relative w-full h-2 bg-gray-200 rounded-full">
                <div class="absolute top-0 left-0 h-2 bg-primary rounded-full transition-all duration-300" style="width: {{ $currentStep / 2 * 100 }}%;"></div>
            </div>
            <!-- Step Indicators -->
            <div class="flex justify-between items-center mt-3">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-full {{ $currentStep >= 1 ? 'bg-primary text-white' : 'bg-gray-200 text-gray-500' }} flex items-center justify-center font-bold">
                        1
                    </div>
                    <span class="font-medium {{ $currentStep >= 1 ? 'text-primary' : 'text-gray-400' }}">Company Essentials</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-full {{ $currentStep >= 2 ? 'bg-primary text-white' : 'bg-gray-200 text-gray-500' }} flex items-center justify-center font-bold">
                        2
                    </div>
                    <span class="font-medium {{ $currentStep >= 2 ? 'text-primary' : 'text-gray-400' }}">Company Address</span>
                </div>
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-full {{ $currentStep >= 3 ? 'bg-primary text-white' : 'bg-gray-200 text-gray-500' }} flex items-center justify-center font-bold">
                        2
                    </div>
                    <span class="font-medium {{ $currentStep >= 3 ? 'text-primary' : 'text-gray-400' }}">Optional Details</span>
                </div>
            </div>
        </div>

        <!-- Form Header -->
        <div class="text-center mb-6">
            @if($currentStep == 1)
                <h3 class="text-2xl font-semibold text-primary">Step 1: Company Essentials</h3>
                <p class="text-gray-500 mt-1">Please provide your basic company information</p>
            @elseif($currentStep == 2)
                <h3 class="text-2xl font-semibold text-primary">Step 2: Company Address</h3>
                <p class="text-gray-500 mt-1">Add location information about your company</p>
            @else
                <h3 class="text-2xl font-semibold text-primary">Step 3: Optional Details</h3>
                <p class="text-gray-500 mt-1">Add more information about your company</p>
            @endif
        </div>

        <div class="space-y-5">
            @if($currentStep == 1)
                <!-- Company Name -->
                <div>
                    <label for="company-name" class="block text-sm font-medium text-gray-700">
                        Company Name
                        <span class="text-primary">*</span>
                    </label>
                    <input type="text" id="company-name"
                           wire:model.live="name"
                           class="mt-1 focus:ring-secondary focus:border-secondary block w-full py-3 px-4 sm:text-sm border-gray-300 border-2 rounded-md"
                           placeholder="Enter your company name">
                    @error('name')
                    <p class="mt-2.5 text-sm text-red-500"><span class="font-medium">Invalid company name</span> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Field input -->
                <div>
                    <label for="field" class="block text-sm font-medium text-gray-700">
                        Company Field Operation
                        <span class="text-primary">*</span>
                    </label>
                    <input type="text" id="field"
                           wire:model.live="field"
                           class="mt-1 focus:ring-secondary focus:border-secondary block w-full py-3 px-4 sm:text-sm border-gray-300 border-2 rounded-md"
                           placeholder="e.g., Technology, Healthcare, Finance">
                    @error('field')
                    <p class="mt-2.5 text-sm text-red-500"><span class="font-medium">Invalid fields</span> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Number -->
                <div>
                    <label for="phone-number" class="block text-sm font-medium text-gray-700">
                        Phone Number
                        <span class="text-gray-400">(Optional)</span>
                    </label>
                    <input type="tel" name="phone-number" id="phone-number"
                           wire:model.live="phone"
                           class="mt-1 focus:ring-secondary focus:border-secondary block w-full py-3 px-4 sm:text-sm border-gray-300 border-2 rounded-md"
                           placeholder="+1 (555) 123-4567">
                    @error('phone')
                    <p class="mt-2.5 text-sm text-red-500"><span class="font-medium">Invalid phone</span> {{ $message }}</p>
                    @enderror
                </div>
            @endif

            @if($currentStep == 2)
                <!-- Company Address -->
                <div>
                    <label for="company-address" class="block text-sm font-medium text-gray-700">
                        Company Address
                        <span class="text-primary">*</span>
                    </label>
                    <input type="text" name="company-address" id="company-address"
                           wire:model.live="address"
                           class="mt-1 focus:ring-secondary focus:border-secondary block w-full py-3 px-4 sm:text-sm border-gray-300 border-2 rounded-md"
                           placeholder="Enter your complete business address">
                    @error('address')
                    <p class="mt-2.5 text-sm text-red-500"><span class="font-medium">Invalid address</span> {{ $message }}</p>
                    @enderror
                </div>

                <!-- City -->
                <div>
                    <label for="company-address" class="block text-sm font-medium text-gray-700">
                        City
                        <span class="text-primary">*</span>
                    </label>
                    <input type="text" name="company-address" id="company-address"
                           wire:model.live="city"
                           class="mt-1 focus:ring-secondary focus:border-secondary block w-full py-3 px-4 sm:text-sm border-gray-300 border-2 rounded-md"
                           placeholder="Enter company city location">
                    @error('city')
                    <p class="mt-2.5 text-sm text-red-500"><span class="font-medium">Invalid city</span> {{ $message }}</p>
                    @enderror
                </div>

                <!-- state -->
                <div>
                    <label for="state" class="block text-sm font-medium text-gray-700">
                        Company State
                        <span class="text-primary">*</span>
                    </label>
                    <input type="text" name="company-address" id="state"
                           wire:model.live="state"
                           class="mt-1 focus:ring-secondary focus:border-secondary block w-full py-3 px-4 sm:text-sm border-gray-300 border-2 rounded-md"
                           placeholder="Enter your company state location">
                    @error('state')
                    <p class="mt-2.5 text-sm text-red-500">
                        <span class="font-medium">Invalid state</span> {{ $message }}</p>
                    @enderror
                </div>

                <!-- country -->
                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700">
                        Company Country Location
                        <span class="text-primary">*</span>
                    </label>
                    <input type="text" id="country"
                           wire:model.live="country"
                           class="mt-1 focus:ring-secondary focus:border-secondary block w-full py-3 px-4 sm:text-sm border-gray-300 border-2 rounded-md"
                           placeholder="Enter your company country location">
                    @error('country')
                    <p class="mt-2.5 text-sm text-red-500"><span class="font-medium">Invalid country</span> {{ $message }}</p>
                    @enderror
                </div>

                <!-- postal code -->
                <div>
                    <label for="postal_code" class="block text-sm font-medium text-gray-700">
                        Company Postal Code
                        <span class="text-primary">*</span>
                    </label>
                    <input type="text" id="postal_code"
                           wire:model.live="postal_code"
                           class="mt-1 focus:ring-secondary focus:border-secondary block w-full py-3 px-4 sm:text-sm border-gray-300 border-2 rounded-md"
                           placeholder="Enter your company postal code">
                    @error('postal_code')
                    <p class="mt-2.5 text-sm text-red-500"><span class="font-medium">Invalid postal code</span> {{ $message }}</p>
                    @enderror
                </div>
            @endif

            @if ($currentStep == 3)
                <!-- Founded Date input -->
                <div>
                    <label for="founded_date" class="block text-sm font-medium text-gray-700">
                        Founded Date
                        <span class="text-gray-400">(Optional)</span>
                    </label>
                    <input type="date" id="founded_date"
                           wire:model.live="founded_date"
                           class="mt-1 focus:ring-secondary focus:border-secondary block w-full py-3 px-4 sm:text-sm border-gray-300 border-2 rounded-md">
                    @error('founded_date')
                    <p class="mt-2.5 text-sm text-red-500"><span class="font-medium">Invalid date</span> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Website input -->
                <div>
                    <label for="website" class="block text-sm font-medium text-gray-700">
                        Company Website
                        <span class="text-gray-400">(Optional)</span>
                    </label>
                    <input type="url" id="website"
                           wire:model.live="website"
                           class="mt-1 focus:ring-secondary focus:border-secondary block w-full py-3 px-4 sm:text-sm border-gray-300 border-2 rounded-md"
                           placeholder="https://example.com">
                    @error('website')
                    <p class="mt-2.5 text-sm text-red-500"><span class="font-medium">Invalid website URL</span> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Description input -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">
                        Company Description
                        <span class="text-primary">*</span>
                    </label>
                    <textarea
                        id="description"
                        wire:model.live="description"
                        rows="4"
                        class="mt-1 focus:ring-secondary focus:border-secondary block w-full py-3 px-4 sm:text-sm border-gray-300 border-2 rounded-md"
                        placeholder="Tell us about your company"></textarea>
                    @error('description')
                    <p class="mt-2.5 text-sm text-red-500"><span class="font-medium">Invalid description</span> {{ $message }}</p>
                    @enderror
                </div>
            @endif

            <!-- Navigation Buttons -->
            <div class="pt-4 flex gap-4">
                @if($currentStep == 1)
                    <button type="button" wire:click="nextStep"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer">
                        Next Step
                    </button>
                @else
                    <button type="button" wire:click="previousStep"
                            class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer">
                        Previous Step
                    </button>
                    <button type="button" wire:click="saveCompany"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-primary hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary cursor-pointer">
                        Complete Setup
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer Security Note -->
    <p class="mt-8 text-sm text-gray-600 text-center flex items-center">
        <!-- Heroicon: lock-closed -->
        <svg class="w-4 h-4 mr-2 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
             fill="currentColor">
            <path fill-rule="evenodd"
                  d="M12 1.5a5.25 5.25 0 00-5.25 5.25v3a3 3 0 00-3 3v6.75a3 3 0 003 3h10.5a3 3 0 003-3v-6.75a3 3 0 00-3-3v-3c0-2.9-2.35-5.25-5.25-5.25zm3.75 8.25v-3a3.75 3.75 0 10-7.5 0v3h7.5z"
                  clip-rule="evenodd"/>
        </svg>
        Your information is secure and encrypted
    </p>
</div>
