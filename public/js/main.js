const parametros  = new URLSearchParams(window.location.search)
    const tipo_mensagem = parametros.get("mensagem")
    const notificacao = document.createElement("div")

    if (tipo_mensagem === "sucesso"){
        notificacao.innerHTML ="operação realizda com sucesso!"
        notificacao.className = "notificacao sucesso"
    }else if (tipo_mensagem === "erro"){
        notificacao.innerHTML = "erro ao realizar operação"
        notificacao.className = "notificacao erro"
    }
document.body.appendChild(notificacao)

const url_sem_parametro = window.location.pathname
window.history.replaceState(null, "",url_sem_parametro)

setTimeout(function(){
    notificacao.remove()
},2000)
