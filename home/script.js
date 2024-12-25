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

function reload(){
    try{
        fetch("./index.php?more=" + more, {
        })
        .then(response => 
            response.text()
        )
        .then(data => {
            document.querySelector("html").innerHTML = data
        })
        .catch(error => {
            console.error("再読み込みエラー:" + error)
            Message("再読み込み中にエラーが発生しました:" + error,"error")
        })
    }catch(error){
        Message("再読み込みに失敗しました：" + error,"error")
    }
}

document.getElementById("morepost").addEventListener("click",() => {
    try{
        more++
        fetch("./index.php?more=" + more, {
        })
        .then(response =>
            response.text()
        )
        .then(data => {
            console.log(data)
            document.querySelector("html").innerHTML = ""
            document.querySelector("html").innerHTML = data.split("\n").slice(1).join("\n")
        })
        .catch(error => {
            console.error("ポストの読み込みエラー:" + error)
            Message("ポストの読み込みにエラーが発生しました:" + error,"error")
        })
    }catch(error){
        Message("ポストの読み込みに失敗しました：" + error,"error")
    }
})