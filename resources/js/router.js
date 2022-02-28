import Vue from "vue";
import Router from "vue-router";


import overview from "./components/dashboard/overview/overview.vue";

import user from "./components/dashboard/user/Home.vue"
import userlist from "./components/dashboard/user/UserList.vue"
import rolelist from "./components/dashboard/user/RoleList.vue"

import category from "./components/dashboard/category/Home.vue"
import categorylist from "./components/dashboard/category/CategoryList.vue"

import gallery from "./components/dashboard/ImageGallery/Home.vue"
import gallerylist from "./components/dashboard/ImageGallery/ImageGalleryList.vue"


import blog from "./components/dashboard/Blog/Home.vue"
import bloglist from "./components/dashboard/Blog/BlogList.vue"
import postadd from "./components/dashboard/Blog/Add.vue"
import blogreply from "./components/dashboard/Blog/BlogReply.vue"

import setting from "./components/dashboard/setting/Home.vue"
import profile from "./components/dashboard/setting/Profile.vue"



let onlyAdmin = [1];

Vue.use(Router);
export default new Router({
    mode: "history",
    routes: [
        {
            path: "/home",
            name: "home",
            component: overview,
            meta: {
                icon: "dashboard",
                title: "Dashboard",
                type: onlyAdmin,
                status: true
            },
            children: [
                {
                    path: "overview",
                    name: "overview",
                    component: overview,
                    meta: {
                        icon: "dashboard",
                        title: "Overview",
                        type: onlyAdmin,
                        status: true
                    }
                }
            ]
        },
        {
            path: "/user",
            name: "user",
            component: user,
            meta: {
                icon: "supervisor_account",
                title: "User",
                type: onlyAdmin,
                status: true
            },
            children: [
                {
                    path: "userlist",
                    name: "userlist",
                    component: userlist,
                    meta: {
                        icon: "class",
                        title: "User List",
                        type: onlyAdmin,
                        status: true
                    }
                },
                {
                    path: "rolelist",
                    name: "rolelist",
                    component: rolelist,
                    type: onlyAdmin,
                    meta: {
                        icon: "class",
                        title: "Role List",
                         type: onlyAdmin,
                        status: true
                    }
                },
               
            ]
        },
        {
            path: "/category",
            name: "category",
            component: category,
            meta: {
                icon: "supervisor_account",
                title: " Category",
                type: onlyAdmin,
                status: true
            },
            children: [
                {
                    path: "categorylist",
                    name: "categorylist",
                    component: categorylist,
                    meta: {
                        icon: "class",
                        title: "Category List",
                        type: onlyAdmin,
                        status: true
                    }
                },
            ]
        },
        {
            path: "/gallery",
            name: "gallery",
            component: gallery,
            meta: {
                icon: "supervisor_account",
                title: " Gallery",
                type: onlyAdmin,
                status: true
            },
            children: [
                {
                    path: "gallerylist",
                    name: "gallerylist",
                    component: gallerylist,
                    meta: {
                        icon: "class",
                        title: "Gallery List",
                        type: onlyAdmin,
                        status: true
                    }
                },
            ]
        },
        {
            path: "/blog",
            name: "blog",
            component: blog,
            meta: {
                icon: "supervisor_account",
                title: " Project",
                type: onlyAdmin,
                status: true
            },
            children: [
                {
                    path: "bloglist",
                    name: "bloglist",
                    component: bloglist,
                    meta: {
                        icon: "class",
                        title: "Blog List",
                        type: onlyAdmin,
                        status: true
                    }
                },
                {
                    path: "add",
                    name: "postadd",
                    component: postadd,
                    meta: {
                        icon: "class",
                        title: "Add ",
                        type: onlyAdmin,
                        status: true
                    }
                },
                {
                    path: "blogreply",
                    name: "blogreply",
                    component: blogreply,
                    meta: {
                        icon: "class",
                        title: "Blog Reply",
                        type: onlyAdmin,
                        status: true
                    }
                },

            ]
        },
        {
            path: "/setting",
            name: "setting",
            component: setting,
            meta: {
                icon: "settings",
                title: "Setting",
                type: onlyAdmin,
                status: true
            },
            children: [
                {
                    path: "profile",
                    name: "profile",
                    component: profile,
                    meta: {
                        icon: "dashboard",
                        title: "Profile",
                        type: onlyAdmin,
                        status: true
                    }
                },
            
            ]
        }
    ]
});

