<x-merchant-layout>

    <!-- 
المشكلة في الميديل وير في الاغلب ومش عارف ليه ولكن 
    تم اختبار الblade , controller , model 
    الربط بينهم جميعا
    وتم اختبار الراوت
    -->


    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <div class="bg-dark wight-full white:bg-gray-800 shadow-md rounded-lg overflow-hidden">
        <div class="p-6 bg-dark border-b border-gray-200">
            <h3 class="text-lg font-medium text-white white:text-gray 900 dark:text-white">Dashboard Overview</h3>
            <p class="mt-2 text-gray gray-400 dark:text-gray-400">From here, you can quickly access your products and
                Blogs.... Create , view , update and Delete your profile informations and Actions.</p>
        </div>
    </div>


    <div class="container mx-auto px-4 py-6">
        <div class="flex justify-between items-lift mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}'s Products
                Management...
            </h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Here you can manage your products, view orders, and
                update
                your profile.</p>
            <a href="{{ route('products.index') }}"
                class="bg-blue-600 hover:bg-blue-700 text-dark px-4 py-2 rounded-lg transition duration-200">
                Manage Your Products
            </a>
        </div>

        <div class="flex justify-between items-lift mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                {{ Auth::user()->name }}'s Blogs
                Management...
            </h2>
            <p class="text-gray-600 dark:text-gray-400 mb-6">
                Here you can manage your blogs, view Posts, update and Delete your Posts.
            </p>
            <a href="{{ route('blogs.index') }}"
                class="bg-blue-600 hover:bg-blue-700 text-dark px-4 py-2 rounded-lg transition duration-200">
                Manage Your blogs.
            </a>
        </div>
    </div>

</x-merchant-layout>