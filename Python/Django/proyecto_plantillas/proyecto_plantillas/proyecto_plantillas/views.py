from django.http import HttpResponse
import datetime
from django.template import Template, Context, loader
from django.shortcuts import render
#primera vista, recibe un request, y devuelve un objeto httpResponse.
def saludo(request):

    return HttpResponse("hola mundo.")

def dame_fecha(request):
    #esta vista, nos devolvera la fecha y hora actual
    fecha_actual = datetime.datetime.now()
    #para incluir una variable, en una cadena podemos seguir la siguiente sintaxis
    documento = "Fecha y Hora Actuales: %s" % fecha_actual
    return HttpResponse(documento)

#aca estamos agregando un parametro anio, que luego lo ingresaremos como parametro en la url
def calcular_edad(request,edad,anio):
    #edad_actual=18
    periodo = anio-2025
    edad_futura = edad + periodo
    documento = "<html><body><h2>En el año %s tendras %s años</h2></body></html>" %(anio,edad_futura)
    return HttpResponse(documento) 

#aca estamos agregando un parametro anio, que luego lo ingresaremos como parametro en la url
def saludo_plantilla(request):
    doc_externo = open("/var/www/html/proyecto_plantillas/proyecto_plantillas/proyecto_plantillas/plantillas/saludo.html")
    tmp = Template(doc_externo.read())
    doc_externo.close()
    cnt = Context()
    documento = tmp.render(cnt)
    return HttpResponse(documento)     

#pasamos una variable a una plantilla y mostramos
def saludo_variable(request):
    nombre = "Marcelo"
    apellido = "Duhalde"
    doc_externo = open("/var/www/html/proyecto_plantillas/proyecto_plantillas/proyecto_plantillas/plantillas/saludo_variable.html")
    tmp = Template(doc_externo.read())
    doc_externo.close()
    cnt = Context({"nombre":nombre, "apellido":apellido})
    documento = tmp.render(cnt)
    return HttpResponse(documento) 

class Persona(object):
    def __init__(self,nombre,apellido):
        self.nombre = nombre
        self.apellido = apellido

def saludo_objeto(request):
    p1 = Persona("Marcelo","Duhalde")
    doc_externo = open("/var/www/html/proyecto_plantillas/proyecto_plantillas/proyecto_plantillas/plantillas/saludo_objeto.html")
    tmp = Template(doc_externo.read())
    doc_externo.close()
    cnt = Context({"persona":p1})
    documento = tmp.render(cnt)
    return HttpResponse(documento)         

def saludo_bucle(request):
    lista_temas = ["tema 1","tema 2","tema 3","tema 4","tema 5"]
    lista_temas_2 = ["tema 1","tema 2","tema 3","tema 4","tema 5"]
    doc_externo = open("/var/www/html/proyecto_plantillas/proyecto_plantillas/proyecto_plantillas/plantillas/saludo_bucle.html")
    tmp = Template(doc_externo.read())
    doc_externo.close()
    cnt = Context({"temas":lista_temas, "temas2":lista_temas_2})
    documento = tmp.render(cnt)
    return HttpResponse(documento)

def saludo_cargador(request):
    lista_temas = ["tema 1","tema 2","tema 3","tema 4","tema 5"]
    lista_temas_2 = ["tema 1","tema 2","tema 3","tema 4","tema 5"]
    #doc_externo = open("/var/www/html/proyecto_plantillas/proyecto_plantillas/proyecto_plantillas/plantillas/saludo_bucle.html")
    #tmp = Template(doc_externo.read())
    #doc_externo.close()
    #cnt = Context({"temas":lista_temas, "temas2":lista_temas_2})
    doc_externo = loader.get_template("saludo_cargador.html")
    documento = doc_externo.render({"temas":lista_temas, "temas2":lista_temas_2})
    return HttpResponse(documento)

def saludo_shortcut(request):
    lista_temas = ["tema 1","tema 2","tema 3","tema 4","tema 5"]
    lista_temas_2 = ["tema 1","tema 2","tema 3","tema 4","tema 5"]
    #doc_externo = open("/var/www/html/proyecto_plantillas/proyecto_plantillas/proyecto_plantillas/plantillas/saludo_bucle.html")
    #tmp = Template(doc_externo.read())
    #doc_externo.close()
    #cnt = Context({"temas":lista_temas, "temas2":lista_temas_2})
    #doc_externo = loader.get_template("saludo_cargador.html")
    #documento = doc_externo.render({"temas":lista_temas, "temas2":lista_temas_2})
    context = {"temas":lista_temas, "temas2":lista_temas_2}
    return render(request, "saludo_shortcut.html", context)    

def curso_c(request):
    fecha_actual = datetime.datetime.now()
    return render(request,"curso_c.html",{"dame_fecha":fecha_actual})

def curso_css(request):
    return render(request,"curso_css.html")