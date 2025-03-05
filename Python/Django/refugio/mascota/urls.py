"""refugio URL Configuration

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/3.0/topics/http/urls/
Examples:
Function views
    1. Add an import:  from my_app import views
    2. Add a URL to urlpatterns:  path('', views.home, name='home')
Class-based views
    1. Add an import:  from other_app.views import Home
    2. Add a URL to urlpatterns:  path('', Home.as_view(), name='home')
Including another URLconf
    1. Import the include() function: from django.urls import include, path
    2. Add a URL to urlpatterns:  path('blog/', include('blog.urls'))
"""
from django.urls import path
from django.contrib.auth.decorators import login_required
from mascota.views import listado, index, mascota_view, mascota_list, mascota_edit, mascota_delete, MascotaListView, MascotaCreateView, MascotaUpdateView, MascotaDeleteView

app_name = 'mascota'

urlpatterns = [
    path('', index, name="index"),
    #path('crear', mascota_view, name="mascota_crear"),
    #path('listar', mascota_list, name="mascota_listar"),
    #path('editar/<int:id_mascota>/', mascota_edit, name="mascota_editar"),
    #path('eliminar/<int:id_mascota>/', mascota_delete, name="mascota_eliminar"),
    #con Clases
    path('crear', login_required(MascotaCreateView.as_view()), name="mascota_crear"),
    path('listar', login_required(MascotaListView.as_view()), name="mascota_listar"),
    path('editar/<int:pk>/', login_required(MascotaUpdateView.as_view()), name="mascota_editar"),
    path('eliminar/<int:pk>/', login_required(MascotaDeleteView.as_view()), name="mascota_eliminar"),

    path('listado', listado, name="listado"),
]
