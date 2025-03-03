from django.shortcuts import render
from django.http import HttpResponse
from gestion_pedidos.models import Articulos
from django.conf import settings 
from django.core.mail import send_mail
from gestion_pedidos.forms import formulario_de_contacto
# Create your views here.
def busqueda_productos(request):
    return render(request,"busqueda_productos.html")

def buscar(request):
    if(request.GET["producto"]):
        #mensaje = "Articulo buscado: "+request.GET["producto"]
        producto = request.GET["producto"]
        if(len(producto) > 20):
            mensaje = "busqueda demasiado larga"
        else:    
            articulos = Articulos.objects.filter(nombre__icontains=producto)
            return render(request, "resultado_busqueda.html",{"articulos":articulos, "query":producto})
    else:
        mensaje = "No se a introducido ninguna producto"
    return HttpResponse(mensaje) 

def contacto(request):
    if(request.method=="POST"):
        mi_formulario = formulario_de_contacto(request.POST)
        if(mi_formulario.is_valid()):
            inf_form = mi_formulario.cleaned_data #con esto voy a obtener la informacion limpia.
            recipient_list = ["mduhalde@dogs.com.ar"]
            send_mail(inf_form["asunto"],inf_form["mensaje"],inf_form["email"],recipient_list)
            return render(request, "gracias.html")
    else:
        mi_formulario = formulario_de_contacto()
        return render(request, "contacto2.html", {"form":mi_formulario})