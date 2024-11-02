
<header>
    <nav class="flex items-center justify-between flex-wrap bg-gradient-to-t from-red-600 to-red-700 p-8  sticky">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <a href="addStyles.php" class="font-bold text-2xl block  lg:inline-block lg:mt-0 text-gray-100 hover:text-white mr-4 tracking-tight">
                .connect
            </a>

        </div>
        <div class="block lg:hidden">
            <button class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white navbar-burger">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <title>Menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                </svg>
            </button>
        </div>
        <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto" id="main-nav">
            <div class="text-sm lg:flex-grow tracking-tight">
                <a href="addStyles.php" class="block mt-4 lg:inline-block lg:mt-0 text-white font-semibold text-sm hover:text-yellow-400 mr-4">
                    Add New Styles
                </a>
                <a href="viewStyles.php" class="block mt-4 lg:inline-block lg:mt-0 text-white font-semibold text-sm hover:text-yellow-400 mr-4">
                    View Existing Styles
                </a>
                <a href="viewAttributes.php" class="block mt-4 lg:inline-block lg:mt-0 text-white font-semibold text-sm hover:text-yellow-400 mr-4">
                    View Style Attributes
                </a>
                <a href="taCalender.php" class="block mt-4 lg:inline-block lg:mt-0 text-white font-semibold text-sm hover:text-yellow-400 mr-4">
                    T/A Calender
                </a>
                <a href="components/logout.php" class="block mt-4 lg:inline-block lg:mt-0 text-white font-semibold text-sm hover:text-yellow-400 ">
                    Logout
                </a>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Get all "navbar-burger" elements
        var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {

            // Add a click event on each of them
            $navbarBurgers.forEach(function($el) {
                $el.addEventListener('click', function() {

                    // Get the "main-nav" element
                    var $target = document.getElementById('main-nav');

                    // Toggle the class on "main-nav"
                    $target.classList.toggle('hidden');

                });
            });
        }

    });
</script>