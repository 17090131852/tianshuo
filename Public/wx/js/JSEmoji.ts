declare var $: any;
declare var Math: any;
declare var Scroller: any;
declare var render: any;

module AllPass {

    export class Emoji {

        data: any = {
            113: "[/\u5472\u7259]",
            112: "[/\u8c03\u76ae]",
            127: "[/\u6d41\u6c57]",
            120: "[/\u5077\u7b11]",
            139: "[/\u518d\u89c1]",
            138: "[/\u6572\u6253]",
            140: "[/\u64e6\u6c57]",
            162: "[/\u732a\u5934]",
            163: "[/\u73ab\u7470]",
            105: "[/\u6d41\u6cea]",
            109: "[/\u5927\u54ed]",
            133: "[/\u5618]",
            116: "[/\u9177]",
            118: "[/\u6293\u72c2]",
            149: "[/\u59d4\u5c48]",
            174: "[/\u4fbf\u4fbf]",
            170: "[/\u70b8\u5f39]",
            155: "[/\u83dc\u5200]",
            121: "[/\u53ef\u7231]",
            102: "[/\u8272]",
            106: "[/\u5bb3\u7f9e]",
            104: "[/\u5f97\u610f]",
            119: "[/\u5410]",
            100: "[/\u5fae\u7b11]",
            111: "[/\u53d1\u6012]",
            110: "[/\u5c34\u5c2c]",
            126: "[/\u60ca\u6050]",
            117: "[/\u51b7\u6c57]",
            166: "[/\u7231\u5fc3]",
            165: "[/\u793a\u7231]",
            122: "[/\u767d\u773c]",
            123: "[/\u50b2\u6162]",
            115: "[/\u96be\u8fc7]",
            114: "[/\u60ca\u8bb6]",
            132: "[/\u7591\u95ee]",
            108: "[/\u7761]",
            152: "[/\u4eb2\u4eb2]",
            128: "[/\u61a8\u7b11]",
            190: "[/\u7231\u60c5]",
            136: "[/\u8870]",
            101: "[/\u6487\u5634]",
            151: "[/\u9634\u9669]",
            130: "[/\u594b\u6597]",
            103: "[/\u53d1\u5446]",
            146: "[/\u53f3\u54fc\u54fc]",
            178: "[/\u62e5\u62b1]",
            144: "[/\u574f\u7b11]",
            191: "[/\u98de\u543b]",
            148: "[/\u9119\u89c6]",
            134: "[/\u6655]",
            129: "[/\u5927\u5175]",
            154: "[/\u53ef\u601c]",
            179: "[/\u5f3a]",
            180: "[/\u5f31]",
            181: "[/\u63e1\u624b]",
            182: "[/\u80dc\u5229]",
            183: "[/\u62b1\u62f3]",
            164: "[/\u51cb\u8c22]",
            161: "[/\u996d]",
            168: "[/\u86cb\u7cd5]",
            156: "[/\u897f\u74dc]",
            157: "[/\u5564\u9152]",
            173: "[/\u74e2\u866b]",
            184: "[/\u52fe\u5f15]",
            189: "[/OK]",
            187: "[/\u7231\u4f60]",
            160: "[/\u5496\u5561]",
            175: "[/\u6708\u4eae]",
            171: "[/\u5200]",
            193: "[/\u53d1\u6296]",
            186: "[/\u5dee\u52b2]",
            185: "[/\u62f3\u5934]",
            167: "[/\u5fc3\u788e]",
            176: "[/\u592a\u9633]",
            177: "[/\u793c\u7269]",
            172: "[/\u8db3\u7403]",
            137: "[/\u9ab7\u9ac5]",
            199: "[/\u6325\u624b]",
            169: "[/\u95ea\u7535]",
            124: "[/\u9965\u997f]",
            125: "[/\u56f0]",
            131: "[/\u5492\u9a82]",
            135: "[/\u6298\u78e8]",
            141: "[/\u62a0\u9f3b]",
            142: "[/\u9f13\u638c]",
            143: "[/\u7cd7\u5927\u4e86]",
            145: "[/\u5de6\u54fc\u54fc]",
            147: "[/\u54c8\u6b20]",
            150: "[/\u5feb\u54ed\u4e86]",
            153: "[/\u5413]",
            158: "[/\u7bee\u7403]",
            159: "[/\u4e52\u4e53]",
            188: "[/NO]",
            192: "[/\u8df3\u8df3]",
            194: "[/\u6004\u706b]",
            195: "[/\u8f6c\u5708]",
            196: "[/\u78d5\u5934]",
            197: "[/\u56de\u5934]",
            198: "[/\u8df3\u7ef3]",
            200: "[/\u6fc0\u52a8]",
            201: "[/\u8857\u821e]",
            202: "[/\u732e\u543b]",
            203: "[/\u5de6\u592a\u6781]",
            204: "[/\u53f3\u592a\u6781]",
            107: "[/\u95ed\u5634]"
        };

        lastTapDate: any = new Date;
        el: any = document.getElementById("emojiContainer");
        scroller = null;
        default_width = 294;

        /*计算移动变量*/
        startX = 0;
        x = 0;
        curX = 0;
        clientX = 0;
        clientY = 0;
        isMove = false;
        width = 0;
        index = 0;
        /*计算移动变量*/

        emoji = [];
        input = document.getElementById("emojiInput");

        public Init(dom: any) {
            var ul = this.el.querySelectorAll(".select-area ul");
            this.scroller = ul.length > 0 ? ul[0] : null;
            this.index = 0;
            var img;
            if (window.devicePixelRatio >= 1.5 || $.browser.ie) img = "img/emoji/1@2x.png?max_age=19830211";
            else img = "img/emoji/1.png?max_age=19830211";
            var imgPath = img; (new Image).src = imgPath;
            this.width = this.default_width;
            this.Render(imgPath);
            this.Bind();
        }


        public Render(imgPath: string) {
            var html = this.widgetEmojiSelector({
                imgPath: imgPath
            });
            this.el.innerHTML = html;
            var ul = this.el.querySelectorAll(".select-area ul");
            this.scroller = ul.length > 0 ? ul[0] : null;
        }


        public Bind() {
            var self = this;
            this.Unbind();

            var emoji = this.el.querySelectorAll("[data-emoji]");
            for (var i = 0; i < emoji.length; i++) {
                emoji[i].addEventListener("click", function () {
                    var now: any = new Date;
                    if (now - self.lastTapDate < 500) return;
                    self.lastTapDate = now;
                    var id = this.getAttribute("data-emoji");
                    self.addEmoj({
                        ubb: "[em]e" + id + "[/em]",
                        str: self.data[id]
                    });
                    //alert("emoji");
                });
            }

            var deleteEmoji = this.el.querySelectorAll('[data-oper="delete"]');
            for (var j = 0; j < deleteEmoji.length; j++) {
                deleteEmoji[j].addEventListener("click",
                    function () {
                        var now: any = new Date;
                        if (now - self.lastTapDate < 500) return;
                        self.lastTapDate = now;
                        self.removeEmoj();
                    });
            }

            var selfTouchFunction = function (e) {
                self.HandleEvent(e);
            };

            //绑定touch事件
            this.el.addEventListener("touchstart", selfTouchFunction);
            this.el.addEventListener("touchmove", selfTouchFunction);
            this.el.addEventListener("touchcancel", selfTouchFunction);
            this.el.addEventListener("touchend", selfTouchFunction);
        }

        public HandleEvent(e: any) {
            switch (e.type) {
                case "touchstart":
                    this.onTouchStart(e);
                    break;
                case "touchmove":
                    this.onTouchMove(e);
                    break;
                case "touchcancel":
                case "touchend":
                    this.onTouchEnd(e);
                    break;
            }
        }


        public onTouchStart(e: any) {
            var self = this;
            var point = e.touches ? e.touches[0] : e;
            self.startX = self.x = self.scroller.getBoundingClientRect().left - self.scroller.parentNode.getBoundingClientRect().left;
            self.curX = point.clientX - self.x;
            self.clientX = point.clientX;
            self.clientY = point.clientY;

            self.isMove = false;
        }

        public onTouchMove(e: any) {
            var self = this;
            var point = e.touches ? e.touches[0] : e;
            self.x = point.clientX - self.curX;
            self.x = Math.min(self.x > 0, Math.max(self.width * -4, self.x));

            self.scroller.style.transform = self.scroller.style.msTransform = self.scroller.style.OTransform = self.scroller.style.MozTransform = self.scroller.style.webkitTransform = 'translate(' + this.x + 'px,0px) ';

            self.isMove = true;
            e.preventDefault();
        }
        public onTouchEnd(e: any) {
            var self = this;
            if (self.isMove) {
                var dist = self.x - self.startX;
                if (Math.abs(dist) > self.width / 10) {
                    self.index = Math.max(0, Math.min(4, dist < 0 ? self.index + 1 : self.index - 1));

                     self.scroller.style.transform = self.scroller.style.msTransform = self.scroller.style.OTransform = self.scroller.style.MozTransform = self.scroller.style.webkitTransform = 'translate(' + (-this.index * this.width) + 'px,0px) ';

                    var pagearea = self.el.querySelectorAll(".page-area i");
                    for (var i = 0; i < pagearea.length; i++) {
                        var pg = pagearea[i];
                        i == self.index ? pg.classList.add("current") : pg.classList.remove("current");
                    }
                } else {
                     self.scroller.style.transform = self.scroller.style.msTransform = self.scroller.style.OTransform = self.scroller.style.MozTransform = self.scroller.style.webkitTransform = 'translate(' + -this.index * this.width + 'px,0px) ';
                }
                e.preventDefault();
            }
        }

        public Unbind() {
            var emoji = this.el.querySelectorAll("[data-emoji]");
            for (var i = 0; i < emoji; i++) {
                emoji[i].removeEventListener("click");
            }
            var deleteemoji = this.el.querySelectorAll('[data-oper="delete"]');
            for (var j = 0; j < deleteemoji; j++) {
                deleteemoji[j].removeEventListener("click");
            }
            this.el.removeEventListener("touchstart");
            this.el.removeEventListener("touchmove");
            this.el.removeEventListener("touchend");
            this.el.removeEventListener("touchcancel");
        }

        //初始化表情html
        private widgetEmojiSelector(data: any) {
            var __p = [],
                _p = function (s) {
                    __p.push(s);
                };
            if (data) {
                __p.push('\t<div class="select-area">');
                var imgPath = data && data.imgPath || "img/emoji/1" + (!window.devicePixelRatio || window.devicePixelRatio >= 1.5 ? "@2x" : "") + ".png?max_age=19830211";
                __p.push('\t\t<ul style="-webkit-transform:translateZ(0px);">\n\t\t\t<li style="background-image:url(');
                _p(imgPath);
                __p.push(')">\n\t\t\t\t<i data-emoji="100"></i><i data-emoji="101"></i><i data-emoji="102"></i><i data-emoji="103"></i><i data-emoji="104"></i><i data-emoji="105"></i><i data-emoji="106"></i><i data-emoji="107"></i><i data-emoji="108"></i><i data-emoji="109"></i><i data-emoji="110"></i><i data-emoji="111"></i><i data-emoji="112"></i><i data-emoji="113"></i><i data-emoji="114"></i><i data-emoji="115"></i><i data-emoji="116"></i><i data-emoji="117"></i><i data-emoji="118"></i><i data-emoji="119"></i><i data-oper="delete"></i>\n\t\t\t</li>\n\t\t\t<li>\n\t\t\t\t<i data-emoji="120"></i><i data-emoji="121"></i><i data-emoji="122"></i><i data-emoji="123"></i><i data-emoji="124"></i><i data-emoji="125"></i><i data-emoji="126"></i><i data-emoji="127"></i><i data-emoji="128"></i><i data-emoji="129"></i><i data-emoji="130"></i><i data-emoji="131"></i><i data-emoji="132"></i><i data-emoji="133"></i><i data-emoji="134"></i><i data-emoji="135"></i><i data-emoji="136"></i><i data-emoji="137"></i><i data-emoji="138"></i><i data-emoji="139"></i><i data-oper="delete"></i>\n\t\t\t</li>\n\t\t\t<li>\n\t\t\t\t<i data-emoji="140"></i><i data-emoji="141"></i><i data-emoji="142"></i><i data-emoji="143"></i><i data-emoji="144"></i><i data-emoji="145"></i><i data-emoji="146"></i><i data-emoji="147"></i><i data-emoji="148"></i><i data-emoji="149"></i><i data-emoji="150"></i><i data-emoji="151"></i><i data-emoji="152"></i><i data-emoji="153"></i><i data-emoji="154"></i><i data-emoji="155"></i><i data-emoji="156"></i><i data-emoji="157"></i><i data-emoji="158"></i><i data-emoji="159"></i><i data-oper="delete"></i>\n\t\t\t</li>\n\t\t\t<li>\n\t\t\t\t<i data-emoji="160"></i><i data-emoji="161"></i><i data-emoji="162"></i><i data-emoji="163"></i><i data-emoji="164"></i><i data-emoji="165"></i><i data-emoji="166"></i><i data-emoji="167"></i><i data-emoji="168"></i><i data-emoji="169"></i><i data-emoji="170"></i><i data-emoji="171"></i><i data-emoji="172"></i><i data-emoji="173"></i><i data-emoji="174"></i><i data-emoji="175"></i><i data-emoji="176"></i><i data-emoji="177"></i><i data-emoji="178"></i><i data-emoji="179"></i><i data-oper="delete"></i>\n\t\t\t</li>\n\t\t\t<li>\n\t\t\t\t<i data-emoji="180"></i><i data-emoji="181"></i><i data-emoji="182"></i><i data-emoji="183"></i><i data-emoji="184"></i><i data-emoji="185"></i><i data-emoji="186"></i><i data-emoji="187"></i><i data-emoji="188"></i><i data-emoji="189"></i><i data-emoji="190"></i><i data-emoji="191"></i><i data-emoji="192"></i><i data-emoji="193"></i><i data-emoji="194"></i><i data-emoji="195"></i><i data-emoji="196"></i><i data-emoji="197"></i><i data-emoji="198"></i><i data-emoji="199"></i><i data-oper="delete"></i>\n\t\t\t</li>\n\t\t</ul>\n\t</div>\n\t<div class="page-area"><i class="current"></i><i></i><i></i><i></i><i></i></div>');
            }
            return __p.join("");
        }

        private addEmoj(obj) {

            this.input.value += obj.str;
            this.emoji.push(obj);
        }

        private removeEmoj() {
            var input = this.input;
            var value = input.value;
            if (value == "") return;
            var emoji = this.emoji[this.emoji.length - 1];
            if (emoji && value.lastIndexOf(emoji.str) + emoji.str.length == value.length) {
                value = value.substring(0, value.length - emoji.str.length);
                this.emoji.splice(this.emoji.length - 1, 1);
            } else value = value.substring(0, value.length - 1);
            input.value = value;
        }

    }

}


window.onload = function () {
    var emoj = new AllPass.Emoji;
    emoj.Init(document.body);
};