<template>

    <div class="user">

        <!-- title with search section start -->
        <section class="w-100">
            <div class="row align-items-center justify-content-between">
                <div class="col-4 py-3 h3 fw-bold">
                    Explore
                </div>
                <div class="col-8 col-md-6 col-lg-4 py-3">

                    <!-- search section start -->
                    <div class="position-relative">
                        <input type="text" class="form-control ps-5" placeholder="Search Here anything" v-model="formData.q" @keyup="SearchData">
                        <div class="position-absolute top-50 start-0 translate-middle-y ps-3">
                            <i class="bi bi-search"></i>
                        </div>
                    </div>
                    <!-- search section end -->

                </div>
            </div>
        </section>
        <!-- title with search section end -->

        <!-- page loading section start -->
        <div v-if="loading === true">
            <h6 class="card-text placeholder-glow">
                <span class="p-2">
                    <span class="placeholder col-12 py-3 mb-3"></span>
                </span>
                <span class="p-2">
                    <span class="placeholder col-10 py-3 mb-3"></span>
                </span>
                <span class="p-2">
                    <span class="placeholder col-7 py-3 mb-3"></span>
                </span>
            </h6>
        </div>
        <!-- page loading section end -->

        <!-- no data founded section start -->
        <div class="page-no-data-found" v-if="tableData.length === 0 && loading === false">
            <div class="w-100">
                <div class="mb-3">
                    <i class="bi bi-exclamation-circle fs-1"></i>
                </div>
                <div class="mb-3">There are no data founded</div>
                <span>Click "Upload Photo" to create new data</span>
            </div>
        </div>
        <!-- no data founded section end -->

        <!-- data section start -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 h-100" v-if="tableData.length > 0 && loading === false">
            <div class="p-3 h-100" v-for="each in tableData">
                <div class="bg-white position-relative h-100 shadow">
                    <div class="image-size position-relative h-100">
                        <img :src="each.avatar" :alt="each.title">
                    </div>
                    <div class="position-absolute start-0 bottom-0 p-3">
                        <div class="badge bg-dark p-3">
                            <img :src="'/images/avatar.png'" class="global-avatar me-2" alt="avatar" v-if="each.user.avatar === null">
                            <img :src="each.user.avatar" class="global-avatar me-2" alt="avatar" v-if="each.user.avatar !== null">
                            {{each.user.name}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- data section end -->

        <!-- pagination section start -->
        <div class="d-flex justify-content-center" v-if="tableData.length > 0 && loading === false">
            <div class="pagination">
                <div class="page-item" @click="PrevPage">
                    <a class="page-link" href="javascript:void(0)">
                        <i class="bi bi-caret-left-fill"></i>
                    </a>
                </div>
                <div v-if="buttons.length <= 6" class="d-flex">
                    <div v-for="(page) in buttons" class="page-item" :class="{'active': current_page === page}">
                        <a class="page-link" @click="pageChange(page)" href="javascript:void(0)" v-text="page"></a>
                    </div>
                </div>
                <div v-if="buttons.length > 6" class="d-flex">
                    <div class="page-item" :class="{'active': current_page === 1}">
                        <a class="page-link" @click="pageChange(1)" href="javascript:void(0)">1</a>
                    </div>
                    <div v-if="current_page > 3" class="page-item">
                        <a class="page-link" @click="pageChange(current_page - 2)" href="javascript:void(0)">...</a>
                    </div>
                    <div v-if="current_page === buttons.length" class="page-item" :class="{'active': current_page === (current_page - 2)}">
                        <a class="page-link" @click="pageChange(current_page - 2)" href="javascript:void(0)" v-text="current_page - 2"></a>
                    </div>
                    <div v-if="current_page > 2" class="page-item" :class="{'active': current_page === (current_page - 1)}">
                        <a class="page-link" @click="pageChange(current_page - 1)" href="javascript:void(0)" v-text="current_page - 1"></a>
                    </div>
                    <div v-if="current_page !== 1 && current_page !== buttons.length" class="page-item active">
                        <a class="page-link" @click="pageChange(current_page)" href="javascript:void(0)" v-text="current_page"></a>
                    </div>
                    <div v-if="current_page < buttons.length - 1" class="page-item" :class="{'active': current_page === (current_page + 1)}">
                        <a class="page-link" @click="pageChange(current_page + 1)" href="javascript:void(0)" v-text="current_page + 1"></a>
                    </div>
                    <div v-if="current_page === 1" class="page-item" :class="{'active': current_page === (current_page + 2)}">
                        <a class="page-link" @click="pageChange(current_page + 2)" href="javascript:void(0)" v-text="current_page + 2"></a>
                    </div>
                    <div v-if="current_page < buttons.length - 2" class="page-item">
                        <a class="page-link" @click="pageChange(current_page + 2)" href="javascript:void(0)">...</a>
                    </div>
                    <div class="page-item" :class="{'active': current_page === (current_page - buttons.length)}">
                        <a class="page-link" @click="pageChange(buttons.length)" href="javascript:void(0)" v-text="buttons.length"></a>
                    </div>
                </div>
                <div class="page-item" @click="NextPage">
                    <a class="page-link" href="javascript:void(0)">
                        <i class="bi bi-caret-right-fill"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- pagination section end -->

    </div>

</template>

<script>

    import apiService from "../services/apiServices.js";
    import apiRoute from "../services/apiRoutes.js";

    export default{

        data(){

            return{
                loading: false,
                tableData: [],
                formData: { limit: 12, page: 1 },
                total_pages: 0,
                current_page: 0,
                buttons: [],
                searchTimeout: null,
                error: null,
                responseData: null,
                total_data: 0,
            }

        },

        mounted() {
            this.list();
        },

        methods: {

            /* ------------------------------------------
                User public photo show in list
            --------------------------------------------*/

            list() {
                this.loading = true;
                this.formData.page = this.current_page;
                apiService.POST(apiRoute.global_list, this.formData, (res) => {
                    this.loading = false;
                    console.log(res)
                    if (res.status === 200) {
                        this.tableData = res.data.data;
                        this.total_data = res.data.total;
                        this.total_pages = res.data.total < res.data.per_page ? 1 : Math.ceil((res.data.total / res.data.per_page));
                        this.current_page = res.data.current_page;
                        this.buttons = [...Array(this.total_pages).keys()].map((i) => i + 1);
                    }
                });
            },

            /* ------------------------------------------
                pagination previous list controller
            --------------------------------------------*/

            PrevPage() {
                if (this.current_page > 1) {
                    this.current_page = this.current_page - 1;
                    this.list()
                }
            },

            /* ------------------------------------------
                pagination next list controller
            --------------------------------------------*/

            NextPage() {
                if (this.current_page < this.total_pages) {
                    this.current_page = this.current_page + 1;
                    this.list()
                }
            },

            /* ------------------------------------------
                pagination page change list controller
            --------------------------------------------*/

            pageChange(page) {
                this.current_page = page;
                this.list();
            },

            /* ------------------------------------------
                search list controller
            --------------------------------------------*/

            SearchData() {
                clearTimeout(this.searchTimeout);
                this.searchTimeout = setTimeout(() => {
                    this.list();
                }, 500);
            },

        }

    }

</script>
