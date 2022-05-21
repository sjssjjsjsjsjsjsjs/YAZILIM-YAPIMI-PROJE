<?php
session_start();

if (@$_SESSION["uid"]) {
    echo "<script>location.href = '/home';</script>";
}
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project</title>
</head>

<body>
    <div id="app" class="min-h-screen bg-white flex">

        <div v-if="appLoading" class="fixed flex justify-center items-center bg-white color-black w-full h-full" style="z-index: 9;">
            <svg class="animate-spin -ml-1 mr-3 h-8 w-8 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
        </div>

        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">

            <div v-show="openForgotPw" class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Şifremi Unuttum
                    </h2>
                </div>

                <div class="mt-8">
                    <div class="mt-6">
                        <div class="space-y-6">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Öğrenci Numarası
                                </label>
                                <div class="mt-1">
                                    <input v-model="userFId" id="email" name="email" type="number" autocomplete="studentid" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <button @click="forgotPw(1)" type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Şifre Sıfırlama İsteği
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">
                                veya
                            </span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div>
                            <button @click="signIn()" type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Giriş Yap
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <div v-show="openSignIn" class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Giriş Yap
                    </h2>
                </div>

                <div class="mt-8">
                    <div class="mt-6">
                        <div class="space-y-6">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Öğrenci Numarası
                                </label>
                                <div class="mt-1">
                                    <input v-model="userLId" id="email" name="email" type="number" autocomplete="studentid" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    Şifreniz
                                </label>
                                <div class="mt-1">
                                    <input @keypress.enter="signIn(1)" v-model="userLPw" id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                                        Beni Hatırla
                                    </label>
                                </div>

                                <div class="text-sm">
                                    <a href="javascript:event(0);" @click="forgotPw()" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Şifremi Unuttum
                                    </a>
                                </div>
                            </div>

                            <div>
                                <button @click="signIn(1)" type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Giriş Yap
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">
                                veya
                            </span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div>
                            <button @click="signUp()" type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Hesap Aç
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <div v-show="openSignUp" class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                        Hesap Aç
                    </h2>
                </div>

                <div class="mt-8">
                    <div class="mt-6">
                        <div class="space-y-6">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Öğrenci Numarası
                                </label>
                                <div class="mt-1">
                                    <input v-model="userId" id="email" name="email" type="number" autocomplete="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    Şifreniz
                                </label>
                                <div class="mt-1">
                                    <input v-model="userPw" id="password" name="password" type="password" autocomplete="current-password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>

                            <div>
                                <button @click="signUp(1)" type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Hesap Aç
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 relative">
                        <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">
                                veya
                            </span>
                        </div>
                    </div>

                    <div class="mt-6">
                        <div>
                            <button @click="signIn()" type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Giriş Yap
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="hidden lg:block relative w-0 flex-1">
            <img class="absolute inset-0 h-full w-full object-cover" src="front/assets/bigPicture.webp" alt="">
        </div>
    </div>


    <script src="front/assets/tw.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    keyframes: {
                        spin: {
                            '0%': {
                                transform: 'rotate(0deg)'
                            },
                            '100%': {
                                transform: 'rotate(360deg)'
                            },
                        },
                    }
                }
            }
        }
    </script>
    <script src="front/assets/vue.js"></script>
    <script src="front/assets/axios.js"></script>
    <script>
        const {
            createApp
        } = Vue

        createApp({
            data() {
                return {
                    appLoading: true,
                    openForgotPw: false,
                    openSignUp: false,
                    openSignIn: true,
                    userId: "",
                    userPw: "",
                    userLId: "",
                    userLPw: "",
                    userFId: "",
                }
            },
            mounted() {
                this.appLoading = false;
            },
            created() {

            },
            methods: {
                signIn(state = 0) {
                    if (state == 1) {
                        var params = new URLSearchParams();
                        params.append('r', "login");
                        params.append('id', this.userLId);
                        params.append('pw', this.userLPw);

                        var ref = this;

                        axios.get('/back/server.php?' + params)
                            .then(function(response) {
                                var data = response.data.split(":");
                                if (data[0] == "1") {
                                    alert(data[1]);
                                    location.href = "/home";
                                } else {
                                    alert(data[1]);
                                }
                            })
                            .catch(function(error) {
                                console.log(error);
                            });
                    } else {
                        this.openForgotPw = false;
                        this.openSignUp = false;
                        this.openSignIn = true;
                    }


                },
                signUp(state = 0) {
                    if (state == 1) {
                        var params = new URLSearchParams();
                        params.append('r', "register");
                        params.append('id', this.userId);
                        params.append('pw', this.userPw);

                        var ref = this;

                        axios.get('/back/server.php?' + params)
                            .then(function(response) {
                                var data = response.data.split(":");
                                if (data[0] == "1") {
                                    ref.openSignUp = false;
                                    ref.openSignIn = true;
                                    ref.userLId = ref.userId;
                                    alert(data[1]);
                                } else {
                                    alert(data[1]);
                                }
                            })
                            .catch(function(error) {
                                console.log(error);
                            });
                    } else {
                        this.openForgotPw = false;
                        this.openSignIn = false;
                        this.openSignUp = true;
                    }
                },
                forgotPw(state = 0) {
                    if (state == 1) {
                        var params = new URLSearchParams();
                        params.append('r', "forgotpw");
                        params.append('id', this.userFId);

                        var ref = this;

                        axios.get('/back/server.php?' + params)
                            .then(function(response) {
                                var data = response.data.split(":");
                                if (data[0] == "1") {
                                    alert(data[1]);
                                } else {
                                    alert(data[1]);
                                }
                            })
                            .catch(function(error) {
                                console.log(error);
                            });
                    } else {
                        this.openSignIn = false;
                        this.openSignUp = false;
                        this.openForgotPw = true;
                    }   
                }
            }
        }).mount('#app')
    </script>
</body>

</html>