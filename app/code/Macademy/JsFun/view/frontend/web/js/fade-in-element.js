define(['jquery'], function ($){
    'use strict'

    return function (className, duration){
        $(function (){
            $(className).hide().fadeIn(duration || 2000)
        })
    }
})
