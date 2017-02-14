<?php

namespace websiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use coreBundle\Entity\WebsiteStyxuserbase;
use coreBundle\Entity\WebsiteStyxuserbaseZones;

class FeedController extends Controller
{
  public function indexAction(Request $request)
  {
    $session = new Session();
    $sessionStarted = $this->container->get('session')->isStarted();
    if(!$sessionStarted) {
      $session->start();
    }
    // $request = new Request();

    // $user = $this->container->get('security.context')->getToken()->getUser();
    // var_dump($user);
    // $selected_category = null;  # si un utilisateur se trompe dans son formulaire, on doit garder sa sélection
    // $message = null;            # Message d'erreur pour l'utilisateur
    // $force_show_form = False;   # Doit-on réafficher le formulaire de nouvelle demande ?
    // $form_url = request.get_full_path();
    $repositoryGroup = $this->getDoctrine()->getRepository('coreBundle:WebsiteGroup');
    $repositoryPostPost = $this->getDoctrine()->getRepository('coreBundle:PostPost');
    $repositoryStyxuserbase = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbase');
    $repositoryZone = $this->getDoctrine()->getRepository('coreBundle:WebsiteZone');
    $repositoryStyxuserbaseZones = $this->getDoctrine()->getRepository('coreBundle:WebsiteStyxuserbaseZones');
    $repositoryPostPostZones = $this->getDoctrine()->getRepository('coreBundle:PostPostZones');

    // var_dump($repositoryZone->findById(1)[0]);

    $i = 1;
    while($repositoryPostPost->findById($i) != null) {
      $i++;
    }

    $j = 1;
    while($j < $i) {
      var_dump($repositoryPostPost->findById($j)[0]->getTitle());
      echo "<br/>";
      var_dump($repositoryPostPost->findById($j)[0]->getDescription());
      echo "<br/>";
      var_dump($repositoryPostPost->findById($j)[0]->getCreatedAt()->format('d/m/Y à H:i'));
      echo "<br/><br/>";
      $j++;
    }

    $idUser = $this->getUser()->getId();
    $user = $repositoryStyxuserbase->findById($idUser)[0];
    $user_zone = $repositoryStyxuserbaseZones->findByStyxuserbase($user->getId())[0];

    if ($repositoryGroup->findById($user->getGroup()->getId())[0]->getName() == 'student') {
      if($user_zone->getZone() != NULL) {
        $name_zone = $user_zone->getZone()->getName();  # Nom de la ville de l'utilisateur
      } else {
        $name_zone = 'Orléans';
      }
    } else {
      $name_zone = 'Orléans';
    }
    $filtres = [$name_zone];

    if($session->get('newsfeed_filter') != NULL) {
      $filtre = $session->get('newsfeed_filter');
    } else {
      $filtre = 0;
    }

    $request->query->set('coucou', 'xouxou');

    if(array_key_exists('filter', $request->query->all())) {
      $filtre = $request->query->get('filter');
      $session->set('newsfeed_filter', (Integer)$filtre-1);
      if(array_key_exists('zone', $request->query->all())) {
        $zone = $request->query->get('filter');
        $session->set('zone_filter', $zone);
      }
      header("Location: /feed");
      exit;
    }

    if($user_zone->getZone() != NULL) {
      $zone = $user_zone->getZone();
    } else {
      // $zone = $repositoryZone->findById(1)[0];
    }

    // var_dump($zone);
    // var_dump($session->get('newsfeed_filter'));

    // var_dump($filtre);

    $posts = null;

    if($filtre == 0) {
      $posts = $repositoryPostPostZones->findByZone($zone->getId());
      if($session->get('zone_filter') != NULL) {
        $zone_filter = $session->get('zone_filter');
      } else {
        $zone_filter = 1;
      }
    }

    if($filtre == 1) {
      if($session->get('zone_filter') != NULL) {
        $zone_filter = $session->get('zone_filter');
      } else {
        $zone_filter = 0;
      }
      $posts = $repositoryPostPostZones->findByZone($zone_filter);
      if($repositoryZone->findById($zone_filter)[0] != NULL) {
        $zone = $repositoryZone->findById($zone_filter)[0];
      } else {
        $zone = $repositoryZone->findById(1)[0];
      }
      $name_zone = $zone->getName();
    }


    $futur_event = $repositoryPostPostZones->findBy(array('zone'=>$zone));
    $def_posts = [];
    for ($i=0; $i < sizeof($futur_event); $i++) {
      $futur_event_posts[$i] = $futur_event[$i]->getPost();
      if(!$futur_event_posts[$i]->getDeleted()) {
        $def_posts[] = $futur_event_posts[$i];
      }
    }
    usort($def_posts, function($a, $b) {
      $a_current_date = $a->getPostponedAt() ?: $a->getCreatedAt();
      $b_current_date = $b->getPostponedAt() ?: $b->getCreatedAt();
      if($a_current_date == $b_current_date) {
        return 0;
      } else if($a_current_date > $b_current_date) {
        return 1;
      } else if($a_current_date < $b_current_date) {
        return -1;
      }
    });
    $futur_event = null;
    for ($i=0; $i < 6; $i++) {
      if(!empty($def_posts[$i])) {
        $futur_event[] = $def_posts[$i];
      }
    }

    var_dump($futur_event);








    exit;
    return $this->render('websiteBundle:feed:feed.html.twig');
  }


  //
  // from datetime import timedelta
  // from threading import Thread
  //
  // from django.core.exceptions import ObjectDoesNotExist
  // from django.contrib.auth.decorators import login_required
  // from django.db.models import Sum
  // from django.db.models.functions import Coalesce
  //
  // from django.shortcuts import HttpResponseRedirect, render, render_to_response
  // from django.template import RequestContext
  // from django.template.response import TemplateResponse
  // from django.utils import timezone
  //
  // from core.forms.tutorial import TutoPersonalInfo, TutoCategory
  // from datetime import datetime
  // from post.forms.post import RequestForm, EventForm, NewsForm
  // from post.models.post import Post, Reward, Event
  //
  // from website.forms.manage import ContactAdminForm, FilterCityForm, ConfirmEmailForm
  // from website.models.category import Category
  // from website.models.user import StyxUserBase, StyxUserStudent, TemporaryUser
  // from website.models.category import Type
  // from website.models.zone import Zone
  //
  //
  // from core.api import notification
  // #  from app.styxAPI.styx import NotifManager <------------------------------------------------------------------------
  //
  //
  // public function connected_user_count() {
  //   $since_day = timezone.now() - timedelta(days=3);
  //   $since_day.strftime('%m%d%y');
  //   return len(StyxUserBase.objects.filter(last_login__gt=since_day));
  }
  // @login_required
  // public function feed($request){
    // if ($repositoryGroupe->findGroupNameByUser($user->getGroup()->getId())->getName() == 'student') {
    //   $name_zone = request.user.styxuserstudent.school.zone.name;  # Nom de la ville de l'utilisateur
    // } else {
    //   $name_zone = 'Orléans';
    // }
  //   $filtres = [name_zone];  # , [name_zone, 'Mes amis', 'Mes compétences']  # Nom des différents filtres
  //
  //   $filtre = request.session.get('newsfeed_filter', 0)  # On récupére le filtre sélectionné
  //
  //   # Si un filtre a été sélectionné, on le sauvegarde et on recharge la view de la page sans les données GET
  //   if ('filter' in request.GET) {
  //     $filtre = request.GET['filter'];
  //     request.session['newsfeed_filter'] = int($filtre) - 1;
  //     if ('zone' in request.GET){
  //       $zone = request.GET['zone'];
  //       request.session['zone_filter'] = $zone;
  //       return HttpResponseRedirect('/feed');
  //     }
  //   }
  //   try {
  //     $zone = request.user.styxuserstudent.school.zone};
  //     catch{
  //       $zone = request.user.zones.all()[0];
  //     }
  //     $posts = null;
  //
  //     if ($filtre == 0){
  //       $posts = Post.objects.get_by_zone($zone);  # [0:10]
  //       $zone_filter = request.session.get('zone_filter', 1);
  //
  //       if ($filtre == 1){
  //         $zone_filter = request.session.get('zone_filter', 0);
  //         $posts = Post.objects.get_by_id_zone(zone_filter);
  //         try{
  //           $zone = Zone.objects.get(id=zone_filter);
  //           catch Zone.DoesNotExist {
  //             $zone = Zone.objects.filter(id=1)[0];
  //           }
  //           $name_zone = zone.name;
  //
  //           futur_event = Event.objects.filter(zones=zone, deleted=False)\
  //           .annotate(current_date=Coalesce('postponed_at', 'created_at'))\
  //           .order_by('-current_date')[0:5]
  //
  //           # FORMULAIRES
  //           form_filter_city = FilterCityForm(city_selected=name_zone)
  //           form_tuto_perso_info = TutoPersonalInfo()
  //           form_tuto_category = TutoCategory()
  //           form_contact_admin = ContactAdminForm()
  //           form_confirm_email = ConfirmEmailForm()
  //
  //           news_form = NewsForm()
  //           request_form = RequestForm()
  //           event_form = EventForm()
  //
  //           if (request.method == "POST"){
  //
  //             if (request.POST['action'] == 'RequestForm'){
  //
  //               try{
  //                 selected_category = Category.objects.get(id=int(request.POST.get('category')))
  //                 except ObjectDoesNotExist:
  //                 pass
  //
  //                 request_form = RequestForm(request.POST, user=request.user)
  //                 if (request_form.is_valid()){
  //                   my_request = request_form.save(commit=False)
  //                   my_request.owner = request.user
  //                   my_request.has_comment = True
  //
  //                   rewards = request_form.cleaned_data["rewards"]
  //                   rewards = Reward.objects.filter(id__in=rewards).aggregate(Sum('binary_value'))
  //                   my_request.rewards = rewards['binary_value__sum']
  //
  //                   my_request.save()
  //                   my_request.zones = [zone]
  //                   my_request.save()
  //
  //                   Thread(target=notification.new_post(my_request)).start()
  //
  //                   elif (request.POST['action'] == 'NewsForm'){
  //                     news_form = NewsForm(request.POST)
  //                     if (request.user.email_confirmed){
  //                       my_news_form = news_form.save(commit=False)
  //                       my_news_form.owner = request.user
  //                       my_news_form.category = Category.objects.get(nameCategory='News')
  //                       my_news_form.has_comment = True
  //                       my_news_form.save()
  //                       my_news_form.zones = [zone]
  //                       my_news_form.save()
  //
  //                       elif (request.POST['action'] == 'EventForm'){
  //                         event_form = EventForm(request.POST)
  //                         if (request.user.email_confirmed){
  //                           my_event_form = event_form.save(commit=False)
  //                           my_event_form.owner = request.user
  //                           my_event_form.has_comment = True
  //                           my_event_form.save()
  //                           my_event_form.zones = [zone]
  //                           my_event_form.save()
  //
  //                           elif (request.POST['action'] == 'TutoPersonalInfo'){
  //                             form = TutoPersonalInfo(request.POST, request.FILES, instance=request.user)
  //
  //                             if (form.is_valid()){
  //                               user = form.save(commit=True)
  //                               user.save()
  //
  //                               elif (request.POST['action'] == 'TutoCategory'){
  //                                 form = TutoCategory(request.POST,  instance=request.user)
  //                                 if (form.is_valid()){
  //                                   user = form.save(commit=True)
  //                                   user.categories = (form.cleaned_data['objects'] + form.cleaned_data['services'])
  //                                   user.save()
  //
  //                                   nb_user_all = StyxUserStudent.objects.all().count() + TemporaryUser.objects.filter(convert=False).count()
  //
  //                                   types = get_available_type(user=request.user,
  //                                   news_form=news_form,
  //                                   request_form=request_form,
  //                                   event_form=event_form)
  //
  //                                   return TemplateResponse(request, 'website/templates/feed/feed.html',
  //                                   {'posts': posts,
  //                                     'filtres': filtres,
  //                                     'filtre': filtre+1,
  //                                     'types': types,
  //                                     'selectedCategory': selected_category,
  //                                     'force_show_form': force_show_form,
  //                                     'message': message,
  //                                     'connectedUser': request.user,
  //                                     'formTutoPersoInfo': form_tuto_perso_info,
  //                                     'formTutoCategory': form_tuto_category,
  //                                     'contactAdminForm': form_contact_admin,
  //                                     'confirmEmailForm': form_confirm_email,
  //                                     'filter_city_form': form_filter_city,
  //                                     'nb_user_all': nb_user_all,
  //                                     'name_zone': name_zone,
  //                                     'futur_event': futur_event,
  //                                     'form_url': form_url,
  //                                     'zone_id': zone_filter
  //                                   })
  //                                 }
  //                               }
  //                             }
  //                           }
  //                         }
  //                       }
  //                     }
  //                   }
  //                 }
  //               }
  //             }
  //           }
  //         }
  //       }
  //     }
  //   }
  // }
  //
  // def get_available_type(user, news_form=NewsForm(), request_form=RequestForm(), event_form=EventForm()):
  //   regex = "'[0-1]*1"
  //   for i in str(user.group.binary_value)[::-1]:
  //     if i == '0':
  //       regex += "[0-1]"
  //     else:
  //       break
  //
  //       regex += "'"
  //
  //       types = Type.objects.extra(where=['binary_value SIMILAR TO ' + regex])
  //
  //       for t in types:
  //         if 'News' in t.name:
  //           t.form = news_form
  //           elif 'Services' in t.name or 'Loisirs' in t.name:
  //             t.form = request_form
  //             elif 'Événement' in t.name:
  //               t.form = event_form
  //               return types
  //
  //
  //               def agenda(request):
  //
  //               zone_id = request.GET.get('zone', None)  # On récupére le filtre sélectionné
  //
  //               if zone_id:
  //                 try:
  //                 zone = Zone.objects.get(pk=zone_id)
  //                 except Zone.DoesNotExist:
  //                 zone = request.user.zones.all()[0]
  //                 elif request.user.group.name == 'student':
  //                   zone = request.user.styxuserstudent.school.zone
  //                 else:
  //                   zone = request.user.zones.all()[0]
  //
  //                   event_form = EventForm()
  //                   form_filter_city = FilterCityForm(city_selected=zone.name)
  //
  //                   if request.method == "POST":
  //                     if request.user.group.name == 'association':
  //                       event_form = EventForm(request.POST)
  //                       if event_form.is_valid():
  //                         my_event_form = event_form.save(commit=False)
  //                         my_event_form.owner = request.user
  //                         my_event_form.has_comment = True
  //                         my_event_form.save()
  //                         my_event_form.zones = [zone]
  //                         my_event_form.save()
  //
  //                         # Bien que l'on sache que l'on a qu'un seul type, on utilise le même pattern que pour la page feed afin d'utiliser
  //                         # le même code pour "new_post.html"
  //                         types = Type.objects.filter(name='Événement')
  //                         id_type = types[0].id
  //
  //                         for t in types:
  //                           t.form = event_form
  //
  //                           form_url = request.get_full_path()
  //
  //                           context = {'zone': zone,
  //                             'connectedUser': request.user,
  //                             'event_form': event_form,
  //                             'filter_city_form': form_filter_city,
  //                             'types': types,
  //                             'id_type': id_type,
  //                             'form_url': form_url,
  //                           }
  //
  //                           return render(request, 'website/templates/feed/agenda.html', context=context)
