from django.urls import include, path
from django.contrib.auth.views import LoginView, LogoutView
from . import views
from rest_framework.routers import DefaultRouter
from .views import TareaViewSet

app_name = 'tareas'

router = DefaultRouter()
router.register(r'tareas', TareaViewSet)

urlpatterns = [
    path('', views.tarea_lista, name='tarea_lista'),
    path('lista_cbv/', views.TareaListView.as_view(), name='tarea_lista_cbv'),
    path('detalle/<int:pk>/', views.TareaDetailView.as_view(), name='tarea_detalle'),
    path('crear/', views.tarea_crear, name='tarea_crear'),
    path('crear-cbv/', views.TareaCreateView.as_view(), name='tarea_crear_cbv'),  # Nueva ruta
    path('login/', LoginView.as_view(template_name='tareas/login.html'), name='login'),
    path('logout/', LogoutView.as_view(next_page='tareas:tarea_lista'), name='logout'),
    path('api/', include(router.urls)),
]