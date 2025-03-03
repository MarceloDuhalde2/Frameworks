"""
URL configuration for proyecto_plantillas project.

The `urlpatterns` list routes URLs to views. For more information please see:
    https://docs.djangoproject.com/en/5.1/topics/http/urls/
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
from django.contrib import admin
from django.urls import path
from proyecto_plantillas.views import saludo, dame_fecha, calcular_edad, saludo_plantilla, saludo_variable, saludo_objeto, saludo_bucle, saludo_cargador, saludo_shortcut, curso_c, curso_css
urlpatterns = [
    path('admin/', admin.site.urls),
    path('saludo/',saludo),
    path('fecha/',dame_fecha),
    path('edades/<int:edad>/<int:anio>', calcular_edad),
    path('saludo2/', saludo_plantilla),
    path('saludo_variable/', saludo_variable),
    path('saludo_objeto/', saludo_objeto),
    path('saludo_bucle/', saludo_bucle),
    path('saludo_cargador/', saludo_cargador),
    path('saludo_shortcut/', saludo_shortcut),
    path('curso_c/', curso_c),
    path('curso_css/', curso_css),

]
