function back(){
    if(document.referrer === ""){
        window.location.href = "../home"
    }else{
        history.back()
    }
}

function Message(message,type) {
    const Element = document.querySelector(".message")

    //連続実行対処
    try{
        Element.classList.remove("show")
        Element.classList.remove("noerror")
        Element.classList.remove("error")
    }catch(error){}

    Element.textContent = message

    if (type === "error") {
        Element.classList.add("error")
    }else if(type === "success") {
        Element.classList.add("noerror")
    }else{
        console.error("Message Type Error")
    }
    Element.classList.add("show")

    // 一定時間後に自動で消す
    setTimeout(() => {
    if(Element.classList.contains("show")){
    try{
        Element.classList.remove("show")
        Element.classList.remove("noerror")
        Element.classList.remove("error")
    }catch(error){}
    }
    }, 3000)
}

document.getElementsByTagName("form")[0].addEventListener("submit", function(event) {
    event.preventDefault()

    fetch("./post.php", {
        method: "POST",
        body: new FormData(document.querySelector("form"))
    })
    .then(response => 
        response.json()
    )
    .then(data => {
        console.log("ポストの送信結果：" + data)
        if(data.indexOf("エラー") > -1){
            Message(data,"error")
        }else{
            Message(data,"success")
        }
    })
    .catch(error => {
        console.error("ポストの送信エラー：" + error)
        Message("ポストの送信にエラーが発生しました：" + error,"error")
    })
})