<!DOCTYPE html>
<html lang="en">
<style>
    #search-results {
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        max-height: 300px;
        overflow-y: auto;
    }

    #search-results div:hover {
        background-color: #f8f9fa;
    }
</style>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/fontawesome-7.1.0/css/all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('vendor/bootstrap-5.3.8.min.css')}}" rel="stylesheet" media="all">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.7/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.6/css/buttons.dataTables.css">

    <!-- Vendor CSS-->
    <link href="{{asset('css/aos.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('css/swiper-bundle-12.0.3.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('vendor/perfect-scrollbar/perfect-scrollbar-1.5.6.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body>

    @include('header')
    @include('sidebar')

    @yield('dashboard')

    @yield('create-student')
    @yield('view-students')

    @yield('edit-student')


    <!-- Jquery JS-->
    <script src="{{asset('js/vanilla-utils.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('vendor/bootstrap-5.3.8.bundle.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('vendor/perfect-scrollbar/perfect-scrollbar-1.5.6.min.js')}}"></script>
    <script src="{{asset('vendor/chartjs/chart.umd.js-4.5.1.min.js')}}"></script>

    <!-- Main JS-->
    <script src="{{asset('js/bootstrap5-init.js')}}"></script>
    <script src="{{asset('js/main-vanilla.js')}}"></script>
    <script src="{{asset('js/swiper-bundle-12.0.3.min.js')}}"></script>
    <script src="{{asset('js/aos.js')}}"></script>
    <script src="{{asset('js/modern-plugins.js')}}"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.6/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.html5.min.js"></script>

    <script>
        new DataTable('#example', {
            pageLength: 10, // Ek page par kitne students dikhen
            layout: {
                topStart: {
                    buttons: [{
                            extend: 'copyHtml5',
                            title: 'Student List',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            } // Sirf pehle 7 columns (Sr se Date tak)
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'Student List',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'csvHtml5',
                            title: 'Student List',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Student List',
                            exportOptions: {
                                columns: [0, 1, 2, 3, 4, 5, 6]
                            }
                        }
                    ]
                }
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('navbar-search');
            const resultsDiv = document.getElementById('search-results');

            const staticPages = [{
                    name: '➕ Create Student',
                    url: "{{ route('students.create') }}"
                },
                {
                    name: '👁️ View All Students',
                    url: "{{ route('students.get_students') }}"
                }
            ];

            searchInput.addEventListener('input', function() {
                const query = this.value.trim().toLowerCase();

                // 1. Har dafa pehle box khali karein
                resultsDiv.innerHTML = '';

                if (query.length > 1) {
                    resultsDiv.style.display = 'block';

                    // Duplicate control karne ke liye array
                    let addedLinks = [];

                    // 2. Static Pages Check
                    staticPages.forEach(page => {
                        if (page.name.toLowerCase().includes(query) && !addedLinks.includes(page.url)) {
                            appendResult(page.name, page.url);
                            addedLinks.push(page.url);
                        }
                    });

                    // 3. Database Search (Fetch)
                    fetch(`/search-students?term=${query}`)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(student => {
                                const studentUrl = `/students/${student.id}/edit`;
                                // Check karein ke ye link pehle se add toh nahi ho gaya
                                if (!addedLinks.includes(studentUrl)) {
                                    appendResult(`👤 Student: ${student.name}`, studentUrl);
                                    addedLinks.push(studentUrl);
                                }
                            });
                        });
                } else {
                    resultsDiv.style.display = 'none';
                }
            });

            function appendResult(name, url) {
                const div = document.createElement('div');
                div.innerHTML = `<a href="${url}" style="display:block; padding:12px; border-bottom:1px solid #eee; color:#333; text-decoration:none;">${name}</a>`;
                resultsDiv.appendChild(div);
            }

            document.addEventListener('click', (e) => {
                if (e.target !== searchInput) resultsDiv.style.display = 'none';
            });
        });
    </script>
</body>

</html>
<!-- end document-->